(function ($) {
    
    $(document).ready(function() {  

// Do not delete above line
/****************************************************************/
/****************************************************************/

$(".fitVids").fitVids();

if(!jQuery('#mc_mv_EMAIL').val()) { 
    jQuery('#mc_mv_EMAIL').attr("placeholder", "Your Email Address");
}  

/***************************************************************
* Main Navigation *
****************************************************************/

function swm_main_navigation() {
    
  setResponsiveMenu();

    $(window).resize(function () { 
       setResponsiveMenu();
    });    

    /* mobile menu show hide ------------------------------------- */

     $('.sf-menu').tinyNav({
        active: 'active',  // class name of active link
        header: 'Navigation'  // default display text for dropdown
    });

    $('#mobile_nav_button').click(function () {
        $('ul.mobi-menu').toggleClass("mobile_nav_active");
        $(this).toggleClass("BtnRed");

        var menu_icon = $('#mobile_nav_button i');

        if($(menu_icon).hasClass("fa-list-ul")) {        
            $(menu_icon).removeClass("fa-list-ul").addClass("fa-times");
        } else {
            $(menu_icon).removeClass("fa-times").addClass("fa-list-ul");        
        } 
  });

    $('.sf-menu > li > a.sf-with-ul').after('<div class="mobile_nav_subarrow"><i class="fa fa-caret-square-o-down"></i></div>');

    $('.mobile_nav_subarrow').click(function () {
      $(this).parent().toggleClass("mobile_sub_menu");
    }); 
  
    /* search box show hide ------------------------------------- */

    $(".search_section").click(function (e) {
        $(".swm_search_box").fadeToggle("fast");
        e.stopImmediatePropagation();
    });

    $(document).click(function () {
        if($(".swm_search_box").is(":visible")) {
            $(".swm_search_box").fadeToggle("fast");
        }
    });

    $(".swm_search_box").click(function (e) {
        e.stopImmediatePropagation();
    });

    function setResponsiveMenu() { 

      var sfMenuItem, itemMaxWidth, itemFinalWidth;

        if ( $(window).width() > 979 ) {            

            $("ul.sf-menu").superfish(); 

            if ( !$('body').hasClass('swm_auto_width_menu_links_off') ) {            
                sfMenuItem = $('ul.sf-menu').children();     
                itemMaxWidth = $('ul.sf-menu').parent().parent().width() / sfMenuItem.length;
                itemFinalWidth = sfMenuItem.css( 'min-width', (itemMaxWidth - 0.01) + 'px' );
            }

        }  //if else window width

    } //setResponsiveMenu function 

    if ( $(window).width() > 979 ) {

        var nav_active_icon = $('#swm_main_menu').attr('data-icons').split(',');

        for (var i=0; i<11; ++i){
            var topNavLink = 'ul.sf-menu>li:nth-child('+(i + 1) +')>a';
            $(topNavLink).attr("data-icon",nav_active_icon[i]);    
        }
           
        var activeMenuItemAnchor = $('.sf-menu>li.current_page_item>a,.sf-menu>li.current-menu-item>a,.sf-menu>li.current-menu-parent>a,.sf-menu>li.current-category-ancestor>a,.sf-menu>li.current-post-ancestor>a,.sf-menu>li.current-page-ancestor>a,.sf-menu>li.current-menu-ancestor>a');

        var activeMenuIcon = $( activeMenuItemAnchor ).attr("data-icon"); 
        $( activeMenuItemAnchor ).after( '<span class="menu_arrow"> <small class="link_icon"><i class="fa ' + activeMenuIcon  + '"></i></small> <small class="arrow_shape"></small></span>' ); 
        $( activeMenuItemAnchor ).before( '<span class="menu_border"></span>' );  

    }

    //donate button top navigation add span
    $('nav.activeDonate > ul > li:last-child > a').wrapInner("<span></span>"); 

}

function swmHexToRgb(str,opacity) { 
    if ( /^#([0-9a-f]{3}|[0-9a-f]{6})$/ig.test(str) ) { 
        var hex = str.substr(1);
        hex = hex.length == 3 ? hex.replace(/(.)/g, '$1$1') : hex;
        var rgb = parseInt(hex, 16);               
        return 'rgba(' + [(rgb >> 16) & 255, (rgb >> 8) & 255, rgb & 255].join(',') + ','+ opacity +')';
    } 

    return false; 
}

/***************************************************************
* Parallax Background *
****************************************************************/
function swm_parallax_on() {

    var dataParallax = $(".swm_section_prallax").attr("data-parallaxtest"), 
        dataParallaxHeader = $(".swm_headerImage").attr("data-parallaxtest");

    if (/Android|webOS|iPhone|iPad|iPod|pocket|psp|kindle|avantgo|blazer|midori|Tablet|Palm|maemo|plucker|phone|BlackBerry|symbian|IEMobile|mobile|ZuneWP7|Windows Phone|Opera Mini/i.test(navigator.userAgent)) {
                
        $(".swm_section_prallax").css('background-attachment','scroll');               
        $(".swm_headerImage").css('background-attachment','scroll');          

    } else {
        $(".swm_parallax_on").each(function(){
            var scrollSpeed  = $(this).attr("data-bg-scrollSpeed"); 
            $(this).parallax( '50%', scrollSpeed);
        });         

        if ( dataParallax == 'true' ) {                      
            $(".swm_section_prallax").css('background-attachment','fixed');
        }

        if ( dataParallaxHeader == 'true' ) {            
            $(".swm_headerImage").css('background-attachment','fixed');
        }  
    }
     
}

/***************************************************************
* Sticky Header *
****************************************************************/

function swm_sticky_header() {
    var swm_sticky_hader = $('header').attr("data-sticky-nav-header");       

    if ( swm_sticky_hader == 'true' ) {

        var shrinkHeader = 100;
        $(window).scroll(function() {
            var scroll = getCurrentScroll();
            if ( scroll >= shrinkHeader ) {
               $('.header').addClass('smaller');
            }
            else {
                $('.header').removeClass('smaller');
            }
        });            
    }
    function getCurrentScroll() {       
        return window.pageYOffset || document.documentElement.scrollTop;
    }    
}

/***************************************************************
* Retina *
****************************************************************/

function swm_retinaRatioCookies() {
    var devicePixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
    if (!$.cookie("pixel_ratio")) {
        if (devicePixelRatio > 1 && navigator.cookieEnabled === true) {
            $.cookie("pixel_ratio", devicePixelRatio, {expires : 360});
            location.reload();
        }
    }
}

/***************************************************************
* Responsive Height *
****************************************************************/

function swm_responsive_height() {  
    if ( !$('body').hasClass('swm_disable_header_auto_height') ) {
        $(window).resize(function(){
            $('.swm_headerImage').each(function(){
                var self = $(this),
                    old_width = 1199,
                    old_height = parseInt(self.attr("data-header-height") || 400),
                    new_width = old_width,
                    new_height = old_height,
                    w_width = $(window).width();
                
                if( w_width <= 1199 ) { new_width = 1000; }
                if( w_width <= 979 ) { new_width = 749; }
                if( w_width <= 767 ) { new_width = 461; }
                if( w_width <= 480 ) { new_width = 301; }

                var ratio =  (new_width / old_width) * old_height;
                new_height = Math.round(ratio);

                $(this).css('max-height',new_height);
                $('.title_section').css('height',new_height);
              
            });
        });
        $(window).trigger('resize');
    } 
} 

/***************************************************************
    * Post Format Gallery *
****************************************************************/

function swm_pf_gallery() { 
    $('.pfi_gallery').imagesLoaded( function() {
        $('.pfi_gallery').flexslider({
            animation: 'fade',
            animationSpeed: 500,
            slideshow: false,
            smoothHeight: false,
            controlNav: true,
            directionNav: true,               
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>'                
        });
    });    
}

/***************************************************************
    * Portfolio Page *
****************************************************************/

function swm_portfolio_items() { 

    $(".swm_portfolio_sort").imagesLoaded( function() {
        $('.swm_portfolio_sort').isotope({
        itemSelector: '.swm_portfolio_isotope',
        masonry: {
            //custom addition
        }
        });
    });

    $('.filter_menu a').click(function(){
        var selector = $(this).attr('data-filter');
        $('.swm_portfolio_sort').isotope({filter: selector});
        $('.filter_menu a.active').removeClass('active');
        $(this).addClass('active');
        return false;
    });

    if ($(window).width() < 768) {
        $('div .swm_horizontal_menu').addClass('h_responsive');
    }

    $(".pf_sort").imagesLoaded( function() {
        $('.pf_sort').isotope({
        itemSelector: '.pf_isotope',
        masonry: {
            //custom addition
        }
        });
    });
}

/***************************************************************
    * Testimonials Page *
****************************************************************/
function swm_testimonials_items() { 
    $(".testimonials_sort").imagesLoaded( function() {
        $('.testimonials_sort').isotope({
        itemSelector: '.testimonials_isotope',
        masonry: {
            //custom addition
        }
        });
    });   

    $('.filter_menu a').click(function(){
        var selector = $(this).attr('data-filter');
        $('.testimonials_sort').isotope({filter: selector});
        $('.filter_menu a.active').removeClass('active');
        $(this).addClass('active');
        return false;
    });     
}

/***************************************************************
* Auto Lightbox *
****************************************************************/

(function($)
{
    $.fn.swm_auto_lightbox = function(variables)
    {
        var defaults = {
            lightboxSelectors: 'a[data-rel^="prettyPhoto"],a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com/watch"] , a[href*="screenr.com"]'
        };

        var options = $.extend(defaults, variables),
            win             = $(window),
            windowWidth     = parseInt(win.width(),10) * 0.8, //lightbox width
            windowHeight    = (windowWidth/16)*9;  // lightbox height

        return this.each(function() {

            var elements = $(options.lightboxSelectors, this),
                lastParent = "",
                counter = 0;

            elements.each(function() {
                var el = $(this),
                    rel = el.data('rel'),
                    getParent = el.parents('.swm_container:eq(0)'),
                    imgGallery = 'img_gallery';

                if(getParent.get(0) != lastParent) {
                    lastParent = getParent.get(0);
                    counter ++;
                }

                if(rel !== "" && typeof rel !== 'undefined') {
                    el.attr('rel','lightbox['+rel+']');
                }

                if((el.attr('rel') === undefined || el.attr('rel') === '')) {
                    if(elements.length > 1) {
                        el.attr('rel','lightbox['+imgGallery+counter+']');
                    } else {
                        el.attr('rel','lightbox');
                    }
                }
            });           

            if($.fn.prettyPhoto) {
                elements.prettyPhoto({ social_tools:'',slideshow: 5000, deeplinking: false, overlay_gallery:false, default_width: windowWidth, default_height: windowHeight });
            }

        });
    };
})(jQuery);

/***************************************************************
* Go top scroll *
****************************************************************/

function swm_go_top_scroll() { 

    var pageScroll = false;
    var $element = $('#go_top_scroll');

    $element.click(function(e) {
        $('body,html').animate({ scrollTop: "0" }, 750, 'easeOutExpo' );
        e.preventDefault();
    });

    $(window).scroll(function() {
        pageScroll = true;
    });

    setInterval(function() {
        if( pageScroll ) {
            pageScroll = false;

            if( $(window).scrollTop() > 300 ) {
                $element.fadeIn('fast');
            } else {
                $element.fadeOut('fast');
            }
        }
    }, 250);    
}

/***************************************************************
* Load All Functions *
****************************************************************/

swm_main_navigation();
swm_retinaRatioCookies();
swm_sticky_header();
swm_parallax_on();
swm_responsive_height();
swm_pf_gallery();
swm_portfolio_items();
swm_testimonials_items();
$('.swm_container').swm_auto_lightbox();
swm_go_top_scroll();

/****************************************************************/
/****************************************************************/
}); })(jQuery);
// Do not delete above lines


// Window OnLoad Functions ##########################################################

(function ($) {

    var $window = $(window);

    $window.load(function(){  

        if ( $('.swm_site_loader').length ){
            $(".swm_site_loader").fadeOut("slow");
        }
       
        /***************************************************************
        * Blog Grid *
        ****************************************************************/

        function swm_BlogGridIsotope() {      

            $(".swm_blog_grid_sort").each(function() {
                var $this   = $(this),
                dataGrid    = $this.attr("data-grid") || 'masonry';

                $this.isotope({
                    itemSelector: '.swm_blog_grid',
                    layoutMode: dataGrid
                });
            });

        } 
        swm_BlogGridIsotope();        
        $window.resize(function () { swm_BlogGridIsotope(); });
        window.addEventListener("orientationchange", function() { swm_BlogGridIsotope(); });

    }); // End on window load
    
})(jQuery); // End jQuery(function($)