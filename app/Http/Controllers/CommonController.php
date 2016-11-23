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

    public function postChangeLanguage($language) 
    {
        Session::put('language',$language);
        App::setLocale($language);
        
        return Redirect::back();
    }
}
