@extends('layouts.dashboard')

@section('content')
<!--Header-->
<!--Header-->

<div class="header small">
    <div class="overlay">
        <h2>{{trans('users.profile_title')}}</h2>
    </div>
</div>

<!--Header END-->

<div class="content"><!--Content Starts-->

    <section class="profile">
        <div class="container">
            <div class="boxes layout-left">
                <div class="box">
                    <h4>{{trans('users.profile_of')}} {{$user->getTranslation(\Session::get('language'))->org_name}}</h4>
                    <p>{{trans('users.registered_as')}} <strong><u>{{$user->userType->code}}</u></strong>. {{trans('users.access_to')}}:</p>
                    <ul>
                        @foreach($user_accesses as $access)
                            <li> {{$access->clAccesses->getTranslation(\Session::get('language'))->access}} </li>
                        @endforeach
                    </ul>
                    <hr>

                    <h5>{{trans('users.description')}}</h5>

                    <blockquote>
                        {{$user->getTranslation(\Session::get('language'))->description}}
                    </blockquote>
                    <p><em>{{trans('users.can_edit_description_at')}} <a href="<?php echo url('user-details') ?>">Моите настройки</a></em></p>

                    <hr>

                    <p><strong>{{trans('common.rating_of')}} {{$user->getTranslation(\Session::get('language'))->org_name}}</strong></p>

                    <div class="rate-form" style="margin: -10px 0 30px 0;">
                        <fieldset class="rating">
                            <input type="radio" id="4star5" name="rating4" value="5" disabled><label for="4star5" title="Отлично">Отлично</label>
                            <input type="radio" id="4star4" name="rating4" value="4" disabled><label for="4star4" title="Много добро">Много добро</label>
                            <input type="radio" id="4star3" name="rating4" value="3" disabled checked><label for="4star3" title="Добро">Добро</label>
                            <input type="radio" id="4star2" name="rating4" value="2" disabled><label for="4star2" title="Средно">Средно</label>
                            <input type="radio" id="4star1" name="rating4" value="1" disabled><label for="4star1" title="Слабо">Слабо</label>
                        </fieldset>
                    </div>

                    <p><em>Оценили са ви 3 потребителя</em></p>

                    <hr>

                    <h5>{{trans('articles.articles_list_title')}}</h5>

                    <p>Всички потребители регистрирани като предлагащи услуги имат право да публикуват статии. Статията трябва да бъде авторски текст и да се вписва в поне една от категориите на Счетоводно.com. Статията ще бъде публикувана от Счетоводно.com след одобрение. Всяка статия трябва да бъде придружена от изображение с размер не по-малък от 1920 px ширина. Изображението трябва да е с уредени авторски права и право на ползване. <strong>Всяка статия, одобрена и публикувана в Счетоводно.com ви добавя половин звезда в оценката на Вашия профил!</strong> При желание моля изпращайте вашите статии в Word формат, придружени от изображение, на <a href="#">editorial@schetovodno.com</a></p>
                    <p>Също така Счетоводно.com ви предлага и възможност за представяне на вашата организация или дейност чрез платена публикация в <a href="<?php echo url('articles') ?>">Статии</a>. За повече информация и тарифи моля да <a href="<?php echo url('contact') ?>">се свържете с нас</a></p>

                    <hr>

                    <h5>Абонамент</h5>

                    <p>Вашият абонамент изтича на <span class="emphasize">13.03.2017</span></p>
                    <p><em>Имайте предвид, че при изтекъл абонамент няма да получавате запитвания до подновяването му.</em></p>

                    <p class="update"><a href="#">Подновете вашия абонамент</a></p>
                    

                </div>

    @endsection



