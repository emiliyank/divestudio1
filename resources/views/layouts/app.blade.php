<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        
        .supplier, .organization{
            display: none;
        }
        
        #all_regions{
            height: 160px;
            padding: 0;
        }
        #cl_regions{
            height: 130px;
            overflow: hidden;
            padding: 5px 15px;
            overflow-y: auto;
        }
        #cl_regions label{
            font-weight: normal;
            display: inline;
        }
        #cl_regions input{
            margin-right: 5px;
        }
        #all_services{
            height: 210px;
            margin-bottom: 15px;
        }
        #all_services table, #cl_services table{
            margin: 0;
            margin-top: -1px;
        }
        #all_services table th:nth-child(1){
            padding-left: 35px;
        }
        #all_services table th:nth-child(2){
            text-align: center;
            width: 150px;
        }
        #cl_services{
            height: 153px;
            overflow: hidden;
            overflow-y: auto;
        }
        #cl_services table td{
            border: 0;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }
        #cl_services table td:nth-child(1){
            width: 30px;
        }
        #cl_services table td:nth-child(3){
            width: 120px;
        }
        #cl_services table td input{
            text-align: right;
        }
        #cl_languages{
            height: 55px;
            overflow: hidden;
            overflow-y: auto;
        }
        #cl_languages label{
            font-weight: normal;
            display: inline;
        }
        #cl_languages input{
            margin-right: 5px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">{{trans('main_layout.menu_home')}}</a></li>
                    <li><a href="{{ url('/ads') }}">{{trans('main_layout.menu_my_ads')}}</a></li>
                </ul>

                <!-- Switch Langueges -->
                 <span class="pull-right">
                     <form class="form" role="form" method="POST" action="{{ url('/postChangeLanguage') }}">
                        {{ csrf_field() }}
                            <div class="form-group col-md-3">
                                <label>{{trans('main_layout.lang')}}</label>
                                <?php
                                    if (Session::has('language')) {
                                        $language = Session::get('language');
                                    }else{
                                        $language = Config::get('app.locale');
                                    }
                                ?>
                                <select name="lang" onchange="this.form.submit()">
                                    <option value="bg" <?php echo ($language==='bg' ? 'selected' : '');?>> bg </option>
                                    <option value="en" <?php echo ($language==='en' ? 'selected' : '');?>> en </option>
                                </select>
                            </div>
                     </form>
                 </span>
                 <!-- /.switch languages -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{trans('main_layout.menu_logout')}}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function(){
            if ( $('#user_type').val() === '2'){ $('.supplier').show(); }
            if ( $('#cl_organization_type_id').val() > 1){ $('.organization').show(); }
            $('#user_type').on('change', function() {
                if ($(this).val() === '2'){
                    $('.supplier').fadeIn(800);
                }
                else{
                    $('.supplier').fadeOut(800);
                }
            });
            $('#cl_organization_type_id').on('change', function() {
                if ($(this).val() > 1){
                    $('.organization').fadeIn(800);
                }
                else{
                    $('.organization').fadeOut(800);
                }
            });
        });
</script>
</body>
</html>
