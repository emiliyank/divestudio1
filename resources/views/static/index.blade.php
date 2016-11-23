@extends('layouts.homepage')
@section('content')
<div class="content"><!--Content Starts-->
	<div class="boxes four-columns">
    	<div class="box box-fit">
        	<h2>По мярка</h2>
            <p>При търсене на услуга вие ще получите само оферти, които отговарят на вашите изисквания и бюджет</p>
        </div>
        <div class="box box-demand">
        	<h2>По поръчка</h2>
            <p>Можете да търсите всякакъв вид счетоводни услуги без значение дали са малки или големи, еднократни или постоянни.</p>
        </div>
        <div class="box box-best">
        	<h2>Най-доброто</h2>
            <p>Сечтоводителите и фирмите, от които ще получавате оферти, са оценявани от своите клиенти - всичко е напълно прозрачно!</p>
        </div>
        <div class="box box-free">
        	<h2>Безплатно</h2>
            <p>Търсенето на услуги и оферти в Счетоводно.com е напълно безплатно! Само трябва да се регистрирате.</p>
        </div>
    </div>
    
<section>
	<div class="container">
    	
        <div class="advertising">
            <div class="desktop"><a href="http://www.dive-accounting.com" target="_blank"><img src="{{asset('/design/img/pic/banners/720x90.jpg')}}" alt="Advertisement"></a></div>
            <div class="mobile"><a href="http://www.dive-accounting.com" target="_blank"><img src="{{asset('/design/img/pic/banners/300x250.jpg')}}" alt="Advertisement"></a></div>
        </div>
        
    	<h1>Последни статии</h1>
    	<div class="boxes boxes-articles">
        
        	<div class="box">
            	<a href="#">
                	<div class="image-wrap">
                    	<img src="{{asset('/design/img/pic/demo_pic_01.jpg')}}" alt="">
                    </div>
                    <h2>Кога се подава декларация по чл.55?</h2>
                    <p class="date">01.12.2016</p>
                    <p class="author">Публикувана от: <strong>Бетон Интелект ООД</strong></p>
                    	<p class="status">Статут: <span class="public">Видима за всички</span></p>
                    <p class="tags"><span>Данъци</span><span>Декларации</span></p>
                    <p>Според ЗДДФЛ чл.55, ал.1 обект на деклариране от юридическите лица и самоосигуряващите се лица – платци на доходи, са: 1. Дължимите окончателни данъци в полза на чуждестранни физически лица по реда на чл. 37 и чл.38 от ЗДДФЛ; 2. Окончателните данъци, дължими върху доходи на местни лица по реда на чл.38 от ЗДДФЛ, като доходи от: дивиденти и ликвидационни дялове, [...]</p>
                </a>
            </div>
            
            <div class="box advertorial">
            	<a href="#">
                	<div class="image-wrap">
                    	<img src="{{asset('/design/img/pic/demo_pic_03.jpg')}}" alt="">
                    </div>
                    <h2>Касова отчетност на ДДС</h2>
                    <p class="date">01.12.2016</p>
                    <p class="author">Публикувана от: <strong>Бетон Интелект ООД</strong></p>
                    <p class="status">Статут: <span class="public">Видима за всички</span></p>
                    <p class="tags"><span>Данъци</span></p>
                    <p>Специалният режим  за касова отчетност на данък  върху  добавената стойност има за цел  да подпомогне регистрирани по Закона за данък  върху добавената стойност (ЗДДС) лица с облагаем оборот до 500 000 евро. Какво предимство дава касовата отчетност на ДДС? Същността на този специален режим се състои в това, че ДДС за доставка става изискуем  на датата на получаване на цялостно или частично плащане по доставката. [...]</p>
                </a>
            </div>
            
            <div class="box">
            	<a href="#">
                	<div class="image-wrap">
                    	<img src="{{asset('/design/img/pic/demo_pic_01.jpg')}}" alt="">
                    </div>
                    <h2>Възстановяване на ДДС от държави-членки на ЕС</h2>
                    <p class="date">01.12.2016</p>
                    <p class="author">Публикувана от: <strong>Бетон Интелект ООД</strong></p>
                    <p class="status">Статут: <span class="private">Само за регистрирани потребители</span></p>
                    <p class="tags"><span>Декларации</span></p>
                    <p>Данъчно задължено лице,  установено на територията на страната, което иска да му бъде възстановен данък върху добавената стойност от друга държава членка на Общността, начислен му за закупени от него стоки, получени услуги или осъществен внос на територията на същата, следва да отговаря на условията, предвидени в  държавата членка по възстановяване. Правата и ограниченията на лицата и периодите за упражняване [...]</p>
                </a>
            </div>
            
        </div>
    </div>
</section>    

</div><!--Content Ends-->
@endsection