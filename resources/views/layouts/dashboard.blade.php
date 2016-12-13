@extends('layouts.master')

@section('template')

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
            @if(Auth::check())
            <ul>
                <li><a href="#">Как работи</a></li>
                <li><a href="{{url('/articles')}}">Статии</a></li>
                <li class="contract"><a href="<?php echo url('ad'); ?>">Нова обява</a></li>
                <li class="login"><a href="#">Моят профил</a></li>
                <li class="message"><a href="#"><span class="temp-hide">Нови съобщения: </span>1</a></li>
                <li class="language"><a href="<?php echo url('postChangeLanguage/' . $select_language); ?>">{{$language_label}}</a></li>
            </ul>
            @else
            <ul>
                <li><a href="#">Как работи</a></li>
                <li><a href="#">Регистрирай се</a></li>
                <li><a href="{{url('/articles')}}">Статии</a></li>
                <li class="contract"><a href="#">Търся</a></li>
                <li class="employ"><a href="#">Предлагам</a></li>
                <li class="login"><a href="{{url('/login')}}">Вход</a></li>
                <li class="language"><a href="<?php echo url('postChangeLanguage/' . $select_language); ?>">{{$language_label}}</a></li>
            </ul>
            @endif
        </nav>
    </div>
</header>
    
    @yield('content')

    @if(Auth::check())
    <div class="box">
        <ul class="user-nav" id="user-nav">
            <li><a href="#">Моят профил</a></li>
            <li><a href="<?php echo url('account'); ?>">Моите данни</a></li>
            @if(Session::has('user_type') && 
                (Session::get('user_type') === Config::get('constants.USER_ROLE_SUPPLIER') || Session::get('user_type') === Config::get('constants.USER_ROLE_ADMIN')))
            <li><a href="<?php echo url('user-details'); ?>">Моите настройки</a></li>
            @endif
            <li><a href="<?php echo url('ads'); ?>">Моите обяви</a></li>
            <li><a href="#">Получени обяви (1)</a></li>
            <li><a href="#">Съобщения</a></li>
            <li><a href="#">Архив</a></li>
            <li class="logout"><a href="<?php echo url('logout'); ?>">Изход</a></li>
        </ul>
    </div>

    
    @endif
</div>
    </div>
    </section>
    </div><!--Content Ends-->
@endsection