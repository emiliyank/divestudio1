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

        <h1><a href="{{url('/')}}" title="Портал за счетоводни услуги - Schetovodno.com">Schetovodno.com</a></h1>
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
                @if(Auth::check())
                    @foreach($main_menu_static_pages as $static_page)
                        <li class="{{$static_page->html_class}}"><a href='{{url("/static-page/$static_page->id")}}'>{{$static_page->getTranslation(\Session::get('language'))->topic}}</a></li>
                    @endforeach
                    <li><a href="{{url('/articles')}}">Статии</a></li>
                    <li class="contract"><a href="{{url('/ad')}}">Нова обява</a></li>
                    <li class="login"><a href="{{url('/user-profile')}}">Моят профил</a></li>
                    <li class="message"><a href="{{url('/user-messages')}}"><span class="temp-hide">Нови съобщения: </span></a></li>
                @else
                    @foreach($unauth_static_pages as $static_page)
                        <li class="{{$static_page->html_class}}"><a href='{{url("/static-page/$static_page->id")}}'>{{$static_page->getTranslation(\Session::get('language'))->topic}}</a></li>
                    @endforeach
                    <li><a href="{{url('/register')}}">Регистрирай се</a></li>
                    <li><a href="{{url('/articles')}}">Статии</a></li>
                    <li class="login"><a href="{{url('/login')}}">Вход</a></li>
                @endif
                <li class="language"><a href="<?php echo url('postChangeLanguage/' . $select_language); ?>">{{$language_label}}</a></li>
            </ul>
        </nav>
    </div>
</header>
    
    @yield('content')

    @if(Auth::check())
    <div class="box">
        <ul class="user-nav" id="user-nav">
            <li><a href="{{url('/user-profile')}}">Моят профил</a></li>
            <li><a href="{{url('/account')}}">Моите данни</a></li>
            @if(Session::has('user_type') && 
                (Session::get('user_type') == Config::get('constants.USER_ROLE_SUPPLIER') || Session::get('user_type') == Config::get('constants.USER_ROLE_ADMIN')))
            <li><a href="{{url('/user-details')}}">Моите настройки</a></li>
            <li><a href="{{url('/ads-list')}}">Получени обяви</a></li>
            <li><a href="{{url('/add-article')}}">Напиши статия</a></li>
            @endif
            @if(Session::has('user_type') && 
                (Session::get('user_type') == Config::get('constants.USER_ROLE_ADMIN')))
                @if(Session::has('admin_accesses') && in_array(Config::get('constants.ADMIN_ACCESS_ARTICLES'), Session::get('admin_accesses')))
                    <li><a href="{{url('/pending-articles')}}">Статии чакащи потвърждение</a></li>
                @endif
                @if(Session::has('admin_accesses') && in_array(Config::get('constants.ADMIN_ACCESS_STATIC_PAGES'), Session::get('admin_accesses')))
                    <li><a href="{{url('/list-static-pages')}}">Статични страници</a></li>
                @endif
                @if(Session::has('admin_accesses') && in_array(Config::get('constants.ADMIN_ACCESS_SETTINGS'), Session::get('admin_accesses')))
                    <li><a href="{{url('/admin-settings')}}">Системни настройки</a></li>
                @endif
                @if(Session::has('admin_accesses') && in_array(Config::get('constants.ADMIN_ACCESS_USERS'), Session::get('admin_accesses')))
                    <li><a href="{{url('/list-users')}}">Списък с потребители</a></li>
                @endif
                @if(Session::has('admin_accesses') && in_array(Config::get('constants.ADMIN_ACCESS_FEEDBACK'), Session::get('admin_accesses')))
                    <li><a href="{{url('/contacts-list')}}">Въпроси от контакти</a></li>
                @endif
                @if(Session::has('admin_accesses') && in_array(Config::get('constants.ADMIN_ACCESS_SERVICES'), Session::get('admin_accesses')))
                    <li><a href="{{url('/services')}}">Категории</a></li>
                @endif
                @if(Session::has('admin_accesses') && in_array(Config::get('constants.ADMIN_ACCESS_STATS'), Session::get('admin_accesses')))
                    <li><a href="{{url('/admin-statistics')}}">Активност на потребителите</a></li>
                @endif
            @endif
            <li><a href="{{url('/ads')}}">Моите обяви</a></li>
            <li><a href="{{url('/user-offers')}}">Предложения</a></li>
            <li><a href="{{url('/user-messages')}}">Съобщения</a></li>
            <li class="logout"><a href="{{url('/logout')}}">Изход</a></li>
        </ul>
    </div>

    
    @endif
</div>
    </div>
    </section>
    </div><!--Content Ends-->
@endsection