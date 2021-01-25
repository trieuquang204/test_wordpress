(function($) {
    "use strict";
    $.fn.visible = function(partial) {
        var $t        = $(this),
        $w            = $(window),
        viewTop       = $w.scrollTop(),
        viewBottom    = viewTop + $w.height(),
        _top          = $t.offset().top + $t.height()/5,
        _bottom       = _top + $t.height(),
        compareTop    = partial === true ? _bottom : _top,
        compareBottom = partial === true ? _top : _bottom;

        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
    };
    $.fn.clickToggle = function(a,b) {
        function cb(){
            [b,a][this._tog^=1].call(this);
        }
        return this.on("click", cb);
    };
})(jQuery);

function brookside_is_mobile(){
    var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
    if(('ontouchstart' in document.documentElement) || windowWidth < 783){
        return true;
    } else {
        return false;
    }
}

function brookside_header_fix()
{
    var win             = jQuery(window),
        header          = jQuery('#header'),
        element         = jQuery('.header7 .header-top, .header1 > #navigation-block'),
        main            = jQuery('.header-version1 #main, .header-version7 #main'),
        header_height   = jQuery('#header.header1').outerHeight() + jQuery('#wpadminbar').outerHeight()-element.outerHeight(),
        set_height      = function()
        {
            element.toggleClass( 'fixed-nav', win.scrollTop() > header_height );
            if (win.scrollTop() > header_height ) {
                newP = element.height();
            } else {
                newP = 0;
            }
            if(!header.hasClass('header-transparent')){
                main.css({
                    paddingTop: (newP) + 'px'
                });
            }
        }

        if(brookside_is_mobile() || !jQuery('#header-main.fixed_header').length) return false;
        win.scroll(set_height);
        set_height();
}
function brookside_header4_fix()
{
    var win             = jQuery(window),
        element         = jQuery('#header.header4, #header.header5, #header.header-custom'),
        menu_link       = jQuery('#header.header-custom #navigation-block ul.wp-megamenu > li, #header.header-custom #navigation-block ul.menu > li, #header.header4 #navigation-block ul.wp-megamenu > li, #header.header4 #navigation-block ul.menu > li, #header.header5 #navigation-block ul.wp-megamenu > li:not(.menu-item-logo), #header.header5 #navigation-block ul.menu > li:not(.menu-item-logo)'),
        main            = jQuery('.header-version4 #main, .header-version5 #main, .header-custom #main'),
        logo            = jQuery('#header.header4 .logo, #header.header5 .logo'),
        header_height   = element.outerHeight(),
        logo_h          = logo.height(),
        set_height      = function()
        {
            jQuery('#header.header4 #navigation-block, #header.header5 #navigation-block, #header.header-custom #navigation-block').removeClass('fixed-nav');
            element.attr('data-original-height', element.height()).addClass('fixed-nav');
            element.toggleClass( 'header-scrolled', win.scrollTop() > 0 );
            var st = win.scrollTop();
            header_height  = element.data('original-height');
            logo_h = logo.outerHeight();

            if(!element.hasClass('header-transparent')){
                main.css({
                    paddingTop: (header_height) + 'px'
                });
            }
        }

        if(brookside_is_mobile() || !jQuery('#header-main.fixed_header').length) return false;
        set_height();
        win.scroll(set_height);
        
}
function brookside_home_parallax(element) {
    jQuery(window).scroll(function () {
        var coords, yPos = (jQuery(window).scrollTop() / 2.5);
        coords = yPos + 'px';
        jQuery(element).css('transform', 'translateY('+coords+')');

    });
}
function brookside_update_sinlge_post_image_height(){
    var h = jQuery(window).height(),
    hl = jQuery('#header').height() + jQuery('#wpadminbar').height();
    var hf = h-hl;
    if( !brookside_is_mobile() ){
        jQuery('.single .fullwidth-image-alt .post-img, .fullwidth-image.fullwidth-image-alt .owl-gallery img').css('height', h);
        jQuery('.post-slider.fullwidth.two_per_row .post-slider-item').css('height', hf - 130)
    } else {
        return false;
    }
}
function brookside_fix_sidebar() {
    var marginTop = jQuery('#header').outerHeight() + jQuery("#wpadminbar").height() + 80;
    var marginTop2 = jQuery('#header').outerHeight() + jQuery("#wpadminbar").height() + 92;
    var mt = jQuery("#wpadminbar").height();
    jQuery('#sidebar.sticky, #sidebar.vc_column_container, .sharebox-sticky').theiaStickySidebar({
      // Settings
      additionalMarginTop: marginTop
    });
    jQuery('#content .woocommerce .single-product .product .summary').theiaStickySidebar({
      // Settings
      additionalMarginTop: marginTop2
    });
    jQuery('.stick-this').theiaStickySidebar({
        additionalMarginTop: mt
    });
}
jQuery( document ).ready( function($) {
	"use strict";
    setTimeout(function(){ brookside_fix_sidebar(); }, 100); 
    brookside_header_fix();
    brookside_header4_fix();
    
    $('body').on('click', 'a[href^="#"]', function(event){
        if( $(this).parent().parent('.tabs').length || $(this).parents('.vc_tta').length ){
            return;
        }
        var $href = $(this).attr('href');
        var hash = $href.substring($href.indexOf('#'));
        var elemTo = $(hash);
        if(elemTo.length){
            var $anchor = $(hash).offset();
            var headerH = jQuery('#header').height() + jQuery('#wpadminbar').height() + 60;
            $('html, body').animate({ scrollTop: $anchor.top-headerH }, 900);
            return false;
        }
    });
    $('body').on('click', '#header .search-link .search-button, #mobile-header .search-link .search-button', function(){
            $('#header .search-area, #mobile-header-block .search-area').addClass('opened');
            return false;
        }
    );
    $('.commentlist li').last().addClass('last_comment');
    $('body').on('click', '.subscribe-popup a.close-button', function(){
        $('#subscribe-popup').animate({opacity:0}, 100).removeClass('opened');
        return false;
    });
    $('body').on('click', '#header .button-subscribe', function(){
        $('#subscribe-popup').animate({opacity:1}, 400).addClass('opened');
        return false;
    });
    $('#subscribe-popup form').on('submit', function (e) {
        e.preventDefault();
        var target = $(this);

        $.ajax({
            type: 'post',
            url: window.location,
            data: target.serialize(),
            success: function (data) {
              target.before($(data).find('#subscribe_message').prop('outerHTML'));
            }
        });
    });
    $('body').on('click', '.search-area .close-search', function(){
        $(this).parent('.search-area').removeClass('opened');
        return false;
    });
    $('body').on('click', '.hidden-area-button a', function(){
        return false;
    });

    $('.hidden-area-button a').clickToggle(
        function(){
            $(this).addClass('opened');
            $('#hidden-area-widgets').addClass('opened');
            return false;
        },function(){
            $(this).removeClass('opened');
            $('#hidden-area-widgets').removeClass('opened');
            return false;
        }
    );

    $('body').on('click', '#hidden-area-widgets a.close-button', function(){
        $(this).parent('#hidden-area-widgets').removeClass('opened');
        $('.hidden-area-button a').trigger('click');
        return false;
    });
    $('body').on('click', '.open-insta-video-lightbox', function(){
        $(this).prev('.insta-video-lightbox').fadeIn();
        return false;
    });
    $('body').on('click', '.close-lightbox', function(){
        $(this).parent().fadeOut();
        $(this).parent().find('#insta-video').trigger('pause');
        return false;
    });
    $('body').on('click', '.insta-video-lightbox', function(){
        $(this).fadeOut();
        $(this).find('#insta-video').trigger('pause');
    });
    $('body').on('click', '.insta-video-lightbox .insta-video-item', function(e){
        e.preventDefault();
    });
    brookside_update_sinlge_post_image_height();
    $(window).resize(function(){
        brookside_update_sinlge_post_image_height();
    });
    if( !brookside_is_mobile() ){
        $(window).scroll(function(){
            //brookside_update_sinlge_post_image_height();
            if($(window).scrollTop() > 200){
                $("#back-to-top").fadeIn(200);
            } else{
                $("#back-to-top").fadeOut(200);
            }
        });
    }
    $('body').on('click', '#back-to-top', function() {
          $('html, body').animate({ scrollTop:0 }, '800');
          return false;
    });
    brookside_home_parallax();
    $('.widget_nav_menu .menu .menu-item').on("click", function(e){
        var submenu = $(this).children('.sub-menu');
        var parent_submenu = $(this).parent();
        if(e.target.tagName.toLowerCase() === 'a') return;
        submenu.toggleClass('sub-menu-show'); //then show the current submenu
        if(submenu.hasClass('sub-menu-show')){
            $('.widget_nav_menu .menu').css('height', submenu.height()+'px');
        } else {
            $('.widget_nav_menu .menu').css('height', parent_submenu.height()+'px');
        }
        if(!$('.sub-menu').hasClass('sub-menu-show')){
            $('.widget_nav_menu .menu').css('height', 'auto');
        } else {
        }
        e.stopPropagation();
        e.preventDefault();
    });

    $('body').on('click', '.wpmm-vertical-tabs-nav li a', function(){
        var url = $(this).attr('href');
        window.location = url;
    });
    $(window).load(function(){
        $('.page-loading').fadeOut('fast').remove();
        
        if( $('#map-block .map-marker').length ){
            if( $('#map-block').visible(true) ){
                $('#map-block .map-marker').addClass('animate-in');
            }
        }
        $(window).scroll(function(){
            if( $('#map-block .map-marker').length ){
                if( $('#map-block').visible(true) ){
                    $('#map-block .map-marker').addClass('animate-in');
                }
            }
        });
    });
    $("body").on("click", '.qty-button', function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal).change();
        $('button[name="update_cart"]').trigger('click');
    });

    $('.sharebox .social-icons').on('touchstart', function(e) {
        //e.preventDefault();
        var target = $( e.target );
        if( target.is('a') && $(this).hasClass('open-icons') ){
        } else {
            $(this).toggleClass('open-icons');
        }
    });
    if( !brookside_is_mobile() ){
        $('.sharebox .social-icons').on('click', function(e) {
            //e.preventDefault();
            var target = $( e.target );
            if( target.is('a') && $(this).hasClass('open-icons') ){
            } else {
                $(this).toggleClass('open-icons');
            }
        });
    }
});