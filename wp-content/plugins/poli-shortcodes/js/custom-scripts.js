(function ($) {$(document).ready(function() {  
// Do not delete above line

/***************************************************************
* Steps List Style *
****************************************************************/

$(".steps ol li:first").addClass("first");	
$(".steps ol li:last").addClass("last");	

$(".steps_with_circle ol").each (function () {
    $("li", this).each (function (i) {
        $(this).prepend("<span>" + (i+1) + "</span>" );
    });
});

/***************************************************************
* Image Slider  *
****************************************************************/

$(".swm_image_slider").each(function(){

	var $this				= $(this),
		slideAnimation		= $this.attr("data-slideAnimation") || 'fade',
		autoslideOn			= $this.attr("data-autoSlide") || 0,
		autoslideInterval	= $this.attr("data-autoSlideInterval") || 7000,
		bulletNav			= $this.attr("data-bulletNavigation") || true,
		arrowNav			= $this.attr("data-arrowNavigation") || true;
	
	if(autoslideOn === "true") { autoslideOn = true; } else { autoslideOn = false; }
	if(bulletNav === "true") { bulletNav = true; } else { bulletNav = false; }
	if(arrowNav === "true") { arrowNav = true; } else { arrowNav = false; }

	$(this).imagesLoaded( function() {
		$(this).flexslider({
		animation: slideAnimation,
		slideshow: autoslideOn,
		controlNav: bulletNav,
		directionNav : arrowNav,
		slideshowSpeed: autoslideInterval,
		smoothHeight: true,
		useCSS: false,		
		prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
		start: function(){
			$('body').removeClass('loading');
		}
		});
	});

});

/***************************************************************
* Recent Posts Full *
****************************************************************/

$(".swm_recent_posts").flexslider();

$('.recent_posts_full .swm_one_half:nth-child(1),.recent_posts_full .swm_one_third:nth-child(1), .recent_posts_full .swm_one_fourth:nth-child(1)').css('margin-left', '0px');

/***************************************************************
* Testimonials *
****************************************************************/

$(".testimonials-bx-slider").each(function(){

	var $this				= $(this),
		animationType		= $this.attr("data-animationType") || 'fade',
		autoSlideshow		= $this.attr("data-autoSlideshow") || true,
		smoothHeight		= $this.attr("data-smoothHeight") || true,
		pauseHover			= $this.attr("data-pauseHover") || true,
		displayNavigation	= $this.attr("data-displayNavigation") || true,
		slideshowSpeed		= $this.attr("data-slideshowSpeed") || 500,
		slideshowInterval	= $this.attr("data-slideshowInterval") || 4000;

	if(autoSlideshow === "true") { autoSlideshow = true; } else { autoSlideshow = false; }
	if(smoothHeight === "true") { smoothHeight = true; } else { smoothHeight = false; }
	if(pauseHover === "true") { pauseHover = true; } else { pauseHover = false; }
	if(displayNavigation === "true") { displayNavigation = true; } else { displayNavigation = false; }

	$(this).bxSlider({
		mode: animationType,
		auto:autoSlideshow,
		autoHover:pauseHover,
		adaptiveHeight: smoothHeight,
		adaptiveHeightSpeed:500,
		speed:slideshowSpeed,
		pause:slideshowInterval,
		controls:displayNavigation,
		nextText			: '<i class="fa fa-chevron-right"></i>',
		prevText			: '<i class="fa fa-chevron-left"></i>'
	});
});

// testimonials slider shortcode

$(".testimonials-bx-slider_two").each(function(){

	var $this				= $(this),
		animationType		= $this.attr("data-animationType") || 'fade',		
		slideshowSpeed		= $this.attr("data-slideshowSpeed") || 500,
		slideshowInterval	= $this.attr("data-slideshowInterval") || 4000;	

	$(this).bxSlider({
		mode: animationType,
		auto:true,
		autoHover:true,
		adaptiveHeight: true,
		adaptiveHeightSpeed:500,
		speed:slideshowSpeed,
		pause:slideshowInterval,
		controls:false		
	});
});

$(".bx-controls-directdion a").append("<i class='icon-chevron-right'></i>");


/***************************************************************
* Toggles *
****************************************************************/

$(".swm_toggle_accordion_container").each( function () {
	if($(this).attr('data-id') === 'closed') {
		$(this).accordion({ header: '.toggle_box_title_accordion', collapsible: true, active: false, heightStyle: 'content', autoHeight: false  });
	} else {
		$(this).accordion({ header: '.toggle_box_title_accordion', collapsible: true, heightStyle: 'content', autoHeight: false });
	}
});

$(".toggle_box").each( function () {
	if($(this).attr('data-id') === 'closed') {
		$(this).accordion({ header: '.toggle_box_title', collapsible: true, active: false, heightStyle: 'content'  });
	} else {
		$(this).accordion({ header: '.toggle_box_title', collapsible: true, heightStyle: 'content'});
	}
});

/***************************************************************
* Tabs *
****************************************************************/

$(".swm_tabs").tabs({ fx: { opacity: 'show' } });

/***************************************************************
* Hide Info Boxes *
****************************************************************/

function hide_boxes(){
	$('span.swm_hide_boxes,span.swm_hide_boxes2').click(function() {
		$(this).parent().fadeOut();
	});
}
hide_boxes();

/***************************************************************
* (3) Hover Social Media Icons *
****************************************************************/

$(".sm_icons ul li").fadeTo("normal", 0.4);
	$(".sm_icons ul li").hover(function(){
		$(this).stop().fadeTo("normal", 1);
	},function(){
		$(this).stop().fadeTo("normal", 0.4);
});

$("#footer .sm_icons ul li, .small-footer .sm_icons ul li").fadeTo("normal", 1);
	$("#footer .sm_icons ul li, .small-footer .sm_icons ul li").hover(function(){
		$(this).stop().fadeTo("normal", 1);
	},function(){
		$(this).stop().fadeTo("normal", 1);
});

/***************************************************************
* Animated Elements, Counter, Pie Chart with WayPoints *
****************************************************************/

if ( typeof window['swm_waypoint'] !== 'function' ) {
    function swm_waypoint() {

        if (typeof jQuery.fn.waypoint !== 'undefined') {

            var element = $('.swm_element_visible'),                
                isMobile = document.documentElement.ontouchstart !== undefined ? true : false;

            /* Element Animations ----------------------------------------- */

            if(isMobile) {
                element.addClass('swm_animation_start');
            }
            else {    
                element.waypoint(function(direction) {
                    $(this).addClass('swm_animation_start');
                }, { offset: '85%' } ); 
            }
            
            /* Stat Counter ----------------------------------------- */

            $('.stat-counter').waypoint(function(direction) {
                $(this).each(function(){

                    var datafinalnumber = $(this).attr('data-finalNumber'),
                        dataspeed = $(this).attr('data-speed');

                    $(this).find('.count').delay(5000).countTo({
                        from: 0,
                        to: datafinalnumber,
                        speed: dataspeed,
                        refreshInterval: 10
                    });

                });
            }, { 
            	triggerOnce: true,
            	offset: '90%' 
            	} 
            );

            /* Pie Chart ----------------------------------------- */
            
		    $('.swm_counter_circle').waypoint(function() {
		        $(this).each(function() {
		        	var $element = $(this).children(".swm_counter_circle_text"); 
		            $(this).children(".swm_counter_circle_text").easyPieChart({
		                barColor: $element.attr('data-trackColor'),
		                trackColor: $element.attr('data-barColor'),
		                scaleColor: false,
		                scaleLength: 5,
		                lineCap: "round",
		                lineWidth: $element.attr('data-lineWidth'),
		                size: $element.attr('data-chartSize'),
		                rotate: 0,
		                animate: $element.attr('data-speed'),
		            });
		        });
		    }, {
		        triggerOnce: true,
		        offset: '100%'
		    });


            /* Progress Bar ----------------------------------------- */   
             
            $('.swm_progress_bar .swm_progress_bar_out').waypoint(function(direction) {  

                var $element = $(this);                 
                  
                $element.each(function () {                   
                    $element.animate({
                        width: $(this).attr("data-width") + '%'
                    }, 2000);
                });

             }, { 
            	triggerOnce: true,
            	offset: '90%' 
            	} 
            );


        } // if fn.waypoint end
    }
}

swm_waypoint();

/****************************************************************/
}); })(jQuery);
// Do not delete above lines