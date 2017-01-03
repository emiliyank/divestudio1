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

        <nav>
            <ul>
                <li><a href="#">Как работи</a></li>
                <li><a href="#">Регистрирай се</a></li>
                <li><a href="{{url('/articles')}}">Статии</a></li>
                <li class="contract"><a href="#">Търся</a></li>
                <li class="employ"><a href="#">Предлагам</a></li>
                <li class="login"><a href="{{url('/login')}}">Вход</a></li>
                <li class="language"><a href="#">EN<span class="temp-hide">GLISH</span></a></li>
			</ul>
            
        </nav>
		
        
        
    </div>
</header>

    @yield('content')

@endsection