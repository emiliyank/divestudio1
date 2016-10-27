<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Session;
use Config;
use Validator;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
	//source: http://mydnic.be/post/laravel-5-and-his-fcking-non-persistent-app-setlocale
    public function show_form()
    {
        $data = Session::all();
        return view('common.switch_languages',
            [
                'session_data'=> $data
            ]);
    }

    public function postChangeLanguage(Request $request) 
    {
        $rules = [
        'language' => 'in:en,bg' //list of supported languages of your application.
        ];

        $language = $request->lang;
        //Input::get('lang'); //lang is name of form select field.
        //$language = Session::get('language',Config::get('app.locale'));

        $validator = Validator::make(compact($language),$rules);

        if($validator->passes())
        {
            Session::put('language',$language);
            App::setLocale($language);
        }
        return Redirect::back();
    }
}
