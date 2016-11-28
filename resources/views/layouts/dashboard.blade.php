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
                <li><a href="#">Статии</a></li>
                <li class="contract"><a href="<?php echo url('ad'); ?>">Нова обява</a></li>
                <li class="login"><a href="#">Моят профил</a></li>
                <li class="message"><a href="#"><span class="temp-hide">Нови съобщения: </span>1</a></li>
                <li class="language"><a href="<?php echo url('postChangeLanguage/' . $select_language); ?>">{{$language_label}}</a></li>
            </ul>
            
        </nav>
    </div>
</header>
    
    @yield('content')

    <div class="box">
        <ul class="user-nav" id="user-nav">
            <li><a href="#">Моят профил</a></li>
            <li><a href="<?php echo url('account'); ?>">Моите данни</a></li>
            <li><a href="<?php echo url('user-details'); ?>">Моите настройки</a></li>
            <li><a href="<?php echo url('ads'); ?>">Моите обяви</a></li>
            <li><a href="#">Получени обяви (1)</a></li>
            <li><a href="#">Съобщения</a></li>
            <li><a href="#">Архив</a></li>
            <li class="logout"><a href="<?php echo url('logout'); ?>">Изход</a></li>
        </ul>
    </div>

    </div>
</div>
</section>


</div><!--Content Ends-->