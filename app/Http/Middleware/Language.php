<?php
// app/Http/Middleware/Language.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        if (Session::has('language')) {
            App::setLocale(Session::get('language'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            session()->put('language', Config::get('app.locale'));
            App::setLocale(Config::get('app.locale'));
        }
        return $next($request);
    }
}