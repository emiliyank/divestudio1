<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CmStaticPage;
use App\CmArticle;
use DateTime;
use DateTimeZone;

class StaticPagesController extends Controller{

	public function __construct()
	{
        //$this->middleware('auth');
	}

	public function index()
	{
		$slider_page = CmStaticPage::getHomeSliderPageId();

		$latest_articles = CmArticle::with('clArticleType', 'createdBy')
			->where('status', '>', 0)
			->orderBy('date_approved', 'desc')
			->take(2)->get();

		return view('static.index',[
			'slider_page_id' => $slider_page->id,
			'latest_articles' => $latest_articles,
			]);
	}

	public function list_static_pages()
	{
		$static_pages = CmStaticPage::with('createdBy')->whereNull('date_deleted')->get();

		return view('static.list_all',[
			'static_pages' => $static_pages,
			]);
	}

	public function add_static_page()
	{
		return view('static.add_static_page');
	}

	public function add_static_page_submit(Request $request)
	{
		$this->validate($request, [
            'topic' => 'required|max:300',
            'content' => 'required',
            ]);
        
        $cm_static_page = new CmStaticPage;
        $cm_static_page->created_by = \Auth::id();
        $cm_static_page->html_class = $request->html_class;
        $cm_static_page->is_in_main_menu = $request->is_in_main_menu;
        $cm_static_page->is_in_footer = $request->is_in_footer;
        $cm_static_page->is_in_unauth = $request->is_in_unauth;
        $cm_static_page->is_home_slider = $request->is_home_slider;
        $cm_static_page->save();

        if(empty(\Session::get('language')))
        {
            $locale = \Config::get('constants.LANGUAGE_BG');
        }else{
            $locale = \Session::get('language');
        }

        $translation = $cm_static_page->getNewTranslation($locale);
        $translation->cm_static_page_id = $cm_static_page->id;
        $translation->topic = $request->topic;
        $translation->content = $request->content;
        $translation->locale = $locale;

        $translation->save();
        
        return redirect("/static-page/$cm_static_page->id");
	}

	public function static_page(CmStaticPage $cm_static_page)
	{
		return view('static.static_page',[
			'cm_static_page' => $cm_static_page
			]);
	}

	public function edit_static_page(CmStaticPage $cm_static_page)
	{
		return view('static.edit_static_page',[
			'cm_static_page' => $cm_static_page
			]);
	}

	public function edit_static_page_submit(Request $request)
	{
		$this->validate($request, [
            'topic' => 'required|max:300',
            'content' => 'required',
            ]);

		$cm_static_page = CmStaticPage::where('id', $request->cm_static_page_id)->first();
		$cm_static_page->html_class = $request->html_class;
		$cm_static_page->is_in_main_menu = $request->is_in_main_menu;
        $cm_static_page->is_in_footer = $request->is_in_footer;
        $cm_static_page->is_in_unauth = $request->is_in_unauth;
        $cm_static_page->is_home_slider = $request->is_home_slider;
        $cm_static_page->updated_by = \Auth::id();
        $cm_static_page->save();

        if(empty(\Session::get('language')))
        {
            $locale = \Config::get('constants.LANGUAGE_BG');
        }else{
            $locale = \Session::get('language');
        }

        $translation = $cm_static_page->translateOrNew($locale);
        $translation->cm_static_page_id = $cm_static_page->id;
        $translation->topic = $request->topic;
        $translation->content = $request->content;
        $translation->locale = $locale;

        $translation->save();
        
        return redirect("/static-page/$cm_static_page->id");
	}

	public function approve_static_page_submit(Request $request)
	{
		$this->validate($request, [
            'status' => 'required',
            ]);

		$cm_static_page = CmStaticPage::where('id', $request->cm_static_page_id)->first();
		$cm_static_page->status = $request->status;
		$cm_static_page->save();
        
        return redirect("/edit-static-page/$cm_static_page->id");
	}

	public function delete_static_page(CmStaticPage $cm_static_page)
	{
		$tz = 'Europe/Sofia';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz));
        $dt->setTimestamp($timestamp);
        $now = $dt->format('Y-m-d H:i:s');

		$cm_static_page->date_deleted = $now;
		$cm_static_page->deleted_by = \Auth::id();

		$cm_static_page->save();
		return redirect("/list-static-pages");
	}

	public function about_roles()
	{
		return view('static.about_roles');
	}

	public function terms_and_conditions()
	{
		return view('static.terms_and_conditions');
	}

	public function faq()
	{
		return view('static.faq');
	}
}
