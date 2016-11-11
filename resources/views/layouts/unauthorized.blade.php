@extends('layouts.master')

@section('layout')

<header>
<!--Loader-->
    <div class="loader">
      <div class="loader-icon"></div>
      <div class="loader-label">Зарежда се</div>
    </div>
<!--Loader END-->
    <div class="container">

        <h1><a href="index.html" title="Портал за счетоводни услуги - Schetovodno.com">Schetovodno.com</a></h1>
        <?php
            if (Session::has('language')) {
                $current_language = Session::get('language');
            }else{
                $current_language = Config::get('app.locale');
            }

            if($current_language == Config::get('constants.LANGUAGE_BG'))
            {
                $select_language = Config::get('constants.LANGUAGE_EN');
            }else
            {
                 $select_language = Config::get('constants.LANGUAGE_BG');
            }
            $language_label = strtoupper($select_language);
        ?>
        <nav>
            <ul>
                <li><a href="#">Как работи</a></li>
                <li><a href="#">Регистрирай се</a></li>
                <li><a href="#">Статии</a></li>
                <li class="contract"><a href="#">Търся</a></li>
                <li class="employ"><a href="#">Предлагам</a></li>
                <li class="login"><a href="{{url('/login')}}">Вход</a></li>
                <li class="language"><a href="<?php echo url('postChangeLanguage/' . $select_language); ?>">{{$language_label}}</a></li>
			</ul>
            
        </nav>
		
        
        
    </div>
</header>

    @yield('content')