<!DOCTYPE HTML>
<html lang="bg" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Портал за счетоводни услуги - Schetovodno.com</title>
    <meta name="description" content="Порталът Schetovodno.com предлага търсене и предлагане на счетоводни услуги в цялата страна">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="{{asset('design/scr/schetistyle.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('design/scr/lightgallery.css')}}">
    <!--[if lte IE 9]><link rel="stylesheet" href="scr/style_ie9.css" type="text/css" media="screen" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="scr/style_ie8.css" type="text/css" media="screen" /><![endif]-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css">
    <link rel="stylesheet" media="screen" href="{{asset('design/scr/jquery.bxslider.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('design/scr/extras.css')}}">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('/design/scr/jquery.bxslider.js')}}"></script>
    <script type="text/javascript" src="{{asset('/design/scr/jquery.parallax-1.1.3.js')}}"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
    <script type="text/javascript" src="{{asset('/design/scr/lightgallery-all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="{{asset('/design/scr/jquery-scrolltofixed-min.js')}}"></script>
    <!--<script type="text/javascript" src="scr/jquery.mixitup.js"></script>-->
    <!--<script type="text/javascript" src="scr/isotope.pkgd.min.js"></script>-->
    <!--<script type="text/javascript" src="scr/masonry.pkgd.min.js"></script>
    <script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>-->
    <!--<script async defer data-pin-hover="true" data-pin-round="true" data-pin-save="false" src="//assets.pinterest.com/js/pinit.js"></script>-->
    <script type="text/javascript" src="{{asset('/design/scr/schetiscript.js')}}"></script>
    <script type="text/javascript" src="{{asset('/design/scr/modernizr.js')}}"></script>

    <script src="{{asset('/jquery-ui-1.12.0/jquery-ui.js')}}"></script>
    <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
    <link href="{{asset('design/scr/jquery-ui.css')}}" rel="stylesheet" property="stylesheet">

    <meta name="theme-color" content="#252525">
    <link rel="apple-touch-icon" href="{{asset('/design/img/icon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('/design/img/icon/icon_195.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/design/img/icon/favicon.ico')}}">
    <link rel="image_src" type="image/jpeg" href="{{asset('/design/img/icon/image_src.jpg')}}">
</head>

<body>

    @yield('template')

<footer>
	<div class="footer-top">
    	<div class="container">
            <div class="float-left">
                <ul class="footer-nav">
                    <li><a href="#">Начало</a></li>
                    <li><a href="#">Как работи</a></li>
                    <li><a href="#">Статии</a></li>
                    <li><a href="#">Регистрация</a></li>
                    <li><a href="#">Вход</a></li>
                    <li><a href="#">За нас</a></li>
                    <li><a href="{{url('/contact')}}">Контакти</a></li>
                    <li><a href="#">Общи условия</a></li>
                </ul>
            </div>
            <div class="float-right">
                <ul class="footer-social">
                    <li class="facebook"><a href="https://www.facebook.com" target="_blank">Facebook</a></li>
                    <li class="twitter"><a href="https://www.twitter.com" target="_blank">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="container">
    	<div class="float-left">
        	<h4><a href="#">Schetovodno.com</a></h4>
        </div>
        <div class="float-right">
        	<p class="copyright">Schetovodno.com &copy; 2016 | <a href="http://www.dive-studio.com" target="_blank" title="Web design by DIVE Studio">Webdesign</a> by DIVE Studio</p>
        </div>
    </div>

</footer>


<script>
$(function() {
    $( "#deadline" ).datepicker({
          showOn: "both",
          buttonImage: "{{asset('design/img/date-button.svg')}}",
          buttonImageOnly: true,
          buttonText: "Select date",
          dateFormat: 'dd-mm-yy'
    });
    //$("img.ui-datepicker-trigger").replaceWith("<div class='date-button'></div>");
});
</script>
</body>
</html>
