<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

use App\CmArticle;
use App\CmArticleTranslation;
use App\ClArticleType;
use App\ClArticleTypeTranslation;
use App\User;
use Image;

class CmArticleController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_form()
    {
        $cl_article_types = ClArticleType::get();
        return view('articles.add_article',[
            'cl_article_types' => $cl_article_types,
            ]);
    }

    public function add_submit(Request $request){
        $this->validate($request, [
            'cl_article_type_id' => 'required|integer|min:1',
            'topic' => 'required|max:300',
            'content' => 'required|max:2000',
            ]);
        
        $cm_article = new CmArticle;
        $cm_article->cl_article_type_id = $request->cl_article_type_id;
        $cm_article->is_paid = $request->is_paid;
        $cm_article->created_by = \Auth::id();
        
        //image upload
        if( ! empty($request->picture))
        {
            $image_name = $request->file('picture')->getClientOriginalName(); 
            $image_extension = $request->file('picture')->getClientOriginalExtension();
            $real_path = $request->file('picture')->getRealPath();
            $image_new_name = \Auth::id() . '_' . md5(microtime(true));
            $thumb_name = $image_new_name  . '_thumb.' . $image_extension;
            $image_new_name = $image_new_name  . '.' . $image_extension;
            $img_destination = base_path() . '/public/images/upload/'.strtolower($image_new_name);
            
            $img = Image::make($real_path);
            $img->save($img_destination);

            $cm_article->picture = $image_new_name;
            $cm_article->picture_original_name = $image_name . '.' . $image_extension;

            $thumb_destination_path = base_path() . '/public/images/upload/thumbnails/'.strtolower($thumb_name);
            $img->resize(\Config::get('constants.THUMB_WIDTH'), \Config::get('constants.THUMB_HEIGHT'), function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_destination_path);
            $cm_article->picture_thumb = $thumb_name;
        }

        $cm_article->save();

        if(empty(\Session::get('language')))
        {
            $locale = \Config::get('constants.LANGUAGE_BG');
        }else{
            $locale = \Session::get('language');
        }

        $translation = $cm_article->getNewTranslation($locale);
        $translation->cm_article_id = $cm_article->id;
        $translation->topic = $request->topic;
        $translation->content = $request->content;
        $translation->locale = \Session::get('language');

        $translation->save();
        
        return redirect("/single-article/$cm_article->id");
    }

    public function user_articles()
    {
        $user_id = \Auth::id();
        $user_articles = CmArticle::where('created_by', $user_id)->get();
        print_r($user_articles);
        // return view('articles.user_articles',[
        //     'user_articles' => $user_articles,
        //     ]);
    }

    public function single_article(CmArticle $cm_article)
    {
        $cm_article_data = CmArticle::with('clArticleType', 'createdBy')->where('id', $cm_article->id)->first(); 
        return view('articles.single_article',[
            'cm_article' => $cm_article_data,
            ]);
    }

    public function approve_article(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            ]);

        $cm_article = CmArticle::where('id', $request->article_id)->first();
        $cm_article->status = $request->status;
        $cm_article->approved_by = \Auth::id();
        $cm_article->date_approved = date('Y-m-d H:i:s');
        $cm_article->save();
        
        return redirect("/single-article/$cm_article->id");
    }
}
