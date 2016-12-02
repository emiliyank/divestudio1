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

        <nav>
            <ul>
                <li><a href="#">Как работи</a></li>
                <li><a href="#">Регистрирай се</a></li>
                <li><a href="#">Статии</a></li>
                <li class="contract"><a href="#">Търся</a></li>
                <li class="employ"><a href="#">Предлагам</a></li>
                <li class="login"><a href="{{url('/login')}}">Вход</a></li>
                <li class="language"><a href="#">EN<span class="temp-hide">GLISH</span></a></li>
			</ul>
            
        </nav>
		
        
        
    </div>
</header>

<!--Slider-->
<div class="slider">

    <div class="slide">
    	<div class="overlay">
        	<div class="slide-left">
            	<h2 class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.5s">Открийте вашия <strong>счетоводител</strong></h2>
                <p class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="1s">Намерете подходящия за вас счетоводител в най-голямата база данни в България</p>
                <p class="sl-animation button" data-os-animation="fadeInLeft" data-os-animation-delay="1.5s"><a href="#">Научете как</a></p>
            </div>
            <div class="slide-right">
               <p class="sl-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s"><img src="{{asset('design/img/pic/slide_01.png')}}" alt="Открийте Вашия счетоводител"></p>   
        	</div>
        </div>
    </div>   
    <div class="slide">
    	<div class="overlay">
        	<div class="slide-left">
            	<h2 class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.5s"><strong>Всички</strong> услуги на едно място</h2>
                <p class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="1s">Всичко за Вашето счетоводство на Schetovodno.com - прозрачно и конкурентно</p>
                <p class="sl-animation button" data-os-animation="fadeInLeft" data-os-animation-delay="1.5s"><a href="#">Научете как</a></p>
            </div>
            <div class="slide-right">
                <p class="sl-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s"><img src="{{asset('/design/img/pic/slide_02.png')}}" alt="Всички услуги на едно място"></p>
        	</div>
        </div>
    </div>
    <div class="slide">
    	<div class="overlay">
        	<div class="slide-left">
            	<h2 class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.5s"><strong>Предложете</strong> счетоводна услуга</h2>
                <p class="sl-animation" data-os-animation="fadeInLeft" data-os-animation-delay="1s">Включете се в Schetovodno.com и предложете услугите си на бъдещите си клиенти</p>
                <p class="sl-animation button" data-os-animation="fadeInLeft" data-os-animation-delay="1.5s"><a href="#">Научете как</a></p>
            </div>
            <div class="slide-right">
                <p class="sl-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.1s"><img src="{{asset('/design/img/pic/slide_03.png')}}" alt="Предложи счетоводна услуга"></p>
        	</div>
        </div>
    </div>
    
    

    
</div>
<!--Slider END-->

    @yield('content')

@endsection