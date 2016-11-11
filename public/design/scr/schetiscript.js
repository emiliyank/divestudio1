/*------------------------------------------------------------------------------------*/
/*                                   LOADING PAGE                                     */
/*------------------------------------------------------------------------------------*/
$(window).on('load', function() {

/* -----------BX Slider (by Steven Wanderski)-------------- */	
	$('.slider').bxSlider({  /* http://bxslider.com/options */
		auto: true,
		speed:700,
		mode: 'fade', /* Transition type. Delete for default sliding */
		controls: false,  
		pause:5000,
		onSliderLoad: function() {onScrollInit($('.sl-animation'));}
		/*video:true,
		 onSliderLoad: function() {$('.slide').find('video').get(0).play()} Video bug fix by Mihail Angelov */
		
	});

	$(".loader").fadeOut("slow");

	
});

/*-----------------------------------------*/

$(function(){
	function evaluate(){
		var item = $(this);
		var relatedItem = $("#" + item.attr("data-related-item")).parent();
	   
		if(item.is(":checked")){
			relatedItem.slideDown(200, function(){equalheight(".boxes .box");});
			//relatedItem.show();
			//equalheight('.boxes .box');
		}else{
			relatedItem.slideUp(200, function(){equalheight(".boxes .box");});
			//relatedItem.hide();
			//equalheight('.boxes .box');   
		}
	}
	
	$('input[type="checkbox"]').click(evaluate).each(evaluate);
});




/* -----------Parallax Effect-------------- */
$(function(){parallaxmydiv();});
$(window).on('resize', parallaxmydiv);

function parallaxmydiv() {
	$("div[class^='parallax']").each(function(index, obj){$(obj).parallax("50%", 0.15)});
}

	
/* -----------On scroll animations using waypoints.js and animate.css (by Harris Konstantourakis)-------------- */	
//<![CDATA[ 
	
	function onScrollInit( items, trigger ) {
		items.each( function() {
		var osElement = $(this),
			osAnimationClass = osElement.attr('data-os-animation'),
			osAnimationDelay = osElement.attr('data-os-animation-delay');
		  
			osElement.css({
				'-webkit-animation-delay':  osAnimationDelay,
				'-moz-animation-delay':     osAnimationDelay,
				'animation-delay':          osAnimationDelay
			});

			var osTrigger = ( trigger ) ? trigger : osElement;
			
			osTrigger.waypoint(function() {
				osElement.addClass('animated').addClass(osAnimationClass);
				},{
					triggerOnce: true,
					offset: '90%'
			});
		});
	}

$(function(){
	

	onScrollInit( $('.os-animation') );
	//onScrollInit( $('.staggered-animation'), $('.staggered-animation-container') );
});//]]>

/* -----------Sticky Footer (by Chtiwi Malek)-------------- */
function positionFooter() { var mFoo = $("footer"); if ((($(document.body).height() + mFoo.outerHeight()) < $(window).height() && mFoo.css("position") == "fixed") || ($(document.body).height() < $(window).height() && mFoo.css("position") != "fixed")) { mFoo.css({ position: "fixed", bottom: "0px" }); } else { mFoo.css({ position: "static" }); } } $(document).ready(function () { positionFooter(); $(window).scroll(positionFooter); $(window).resize(positionFooter); $(window).load(positionFooter); });


/*------------------------------------------------------------------------------------*/
/*                                   DOCUMENT READY                                   */
/*------------------------------------------------------------------------------------*/
$(function(){


/* -----------Light Gallery (License Pending)--------------*/
$(".image-gallery, .masonry").lightGallery({
	thumbnail:true, /*Whether or not shows thumbnails*/
    showThumbByDefault: false, /*Whether or not thumbanils are minified*/
	autoplayControls: false, /*Whether or not shows Play icon*/
	pager: true, /*Whether or not shows paging dots*/
	hash: false, /*Whether or not insert hashtags in the URL*/
	zoom: true, /*Whether or not shows the zoom icons*/
	fullScreen: true, /*Whether or not shows the fullscreen button*/
	download: true, /*Whether or not shows the download button*/
});





/* -----------Append Link for Back to Top-------------- */
$( "body" ).append( '<a href="#top" class="cd-top">Top</a>' );


/* -----------Prepend Menu Icon in Mobile Mode-------------- */
$('nav').prepend('<div id="menu-icon">Menu</div>');

/* -----------Toggle Icon in Mobile Mode-------------- */

$("#menu-icon").click(function() {
    $("nav ul").slideToggle();
	$(this).toggleClass("active");
  });
  
/* -----------Putting Arrows on Each Menu that has Submenu-------------- */

$('nav').find('li ul').parent().addClass('sub-menu');


$('nav').find(".sub-menu").prepend('<span class="sub-menu-button"></span>');
$('nav').find('.sub-menu-button').on('click', function() {
            $(this).toggleClass('sub-menu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide(10);
            }
            else {
              $(this).siblings('ul').addClass('open').show(10);
           }
          });

/* -----------Putting Div Around Images in Gallery-------------- */
$(".image-gallery img").each(function(index, element) {
    $(element).wrap("<div class='image-wrap'></div>");
});

/* -----------Scroll to Fixed (by Big Spotted Dog)-------------- */
//$('.user-nav').scrollToFixed({ marginTop: 100});
//$('.user-nav').scrollToFixed({ marginTop: 100, limit: $('.footer-top').offset().top, zIndex: 3 }); //Mike
//$('.user-nav').scrollToFixed({ marginTop: 100, limit: $('.box').offset().bottom, zIndex: 3 });
//$('.user-nav').scrollToFixed({ marginTop: 100, limit: $('.box').offset().top+$('.box').outerHeight(true), zIndex: 3 });
$('.user-nav').scrollToFixed({ marginTop: 100, limit: $('.box').offset().top+$('.box').outerHeight(true)-$('.user-nav').outerHeight()-40, zIndex: 3 }); //worked!!!






/* -----------Changing class of Select inputs when selected option is not null-------------- */
$("select").on('change',function() {
	var izbrano = this.selectedIndex;

	if (izbrano == "") {
	   $(this).removeClass('selected');
	} else {
	   $(this).addClass('selected');
	}
});



/*------------------------------------------------------------------------------------*/
/*                                   DOCUMENT READY                                   */
/*                                  Closing Brackets                                  */
/*------------------------------------------------------------------------------------*/
});





/* -----------Sticky Header (by Sara Vieira)-------------- */

$(window).scroll(function() {
if ($(this).scrollTop() > 1){  
    $('header').addClass("sticky");
  }
  else{
    $('header').removeClass("sticky");
  }
});




/* -----------Back to Top (by Claudia Romano)-------------- */
jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 400,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 700,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});


/* -----------Equal Column Height (by Michah Godbolt)-------------- */
equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).on('load', function() {
  equalheight('.boxes .box');
});


$(window).on('resize', function(){
  equalheight('.boxes .box');
});


/* -----Not checking the checkbox when clicking on a link inside its label-------- */

$(document).on("tap click", 'label a', function( event, data ){
    event.stopPropagation();
    event.preventDefault();
    window.open($(this).attr('href'), $(this).attr('target'));
    return false;
});

