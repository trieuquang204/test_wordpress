// Navigation Scripts to Show Header on Scroll-Up
jQuery(document).ready(function($) {
    var MQL = 1170;

    //primary navigation slide-in effect
    if ($(window).width() > MQL) {
        var headerHeight = $('.navbar-custom').height();
        $(window).on('scroll', {
                previousTop: 0
            },
            function() {
                var currentTop = $(window).scrollTop();
                //check if user is scrolling up
                if (currentTop < this.previousTop) {
                    //if scrolling up...
                    if (currentTop > 0 && $('.navbar-custom').hasClass('is-fixed')) {
                        $('.navbar-custom').addClass('is-visible');
                    } else {
                        $('.navbar-custom').removeClass('is-visible is-fixed');
                    }
                } else if (currentTop > this.previousTop) {
                    //if scrolling down...
                    $('.navbar-custom').removeClass('is-visible');
                    if (currentTop > headerHeight && !$('.navbar-custom').hasClass('is-fixed')) $('.navbar-custom').addClass('is-fixed');
                }
                this.previousTop = currentTop;
            });
    }
});



// animation social
jQuery(document).ready(function() {
   window.sr = new scrollReveal();
});

//SMOOTH SCROLL
// function scrollNav() {
//       jQuery('.smooth-scroll').click(function(){  
//         //Toggle Class
//         jQuery(".active-scroll").removeClass("active-scroll");      
//         jQuery(this).closest('li').addClass("active-scroll");
//         var theClass = jQuery(this).attr("class");
//         jQuery('.'+theClass).parent('li').addClass('active-scroll');
//         //Animate
//         jQuery('html, body').stop().animate({
//             scrollTop: jQuery( jQuery(this).attr('href') ).offset().top
//         }, 400);
//         return false;
//       });
//       jQuery('.scrollTop a').scrollTop();
//     }
//     scrollNav();
jQuery(function() {
  jQuery('#bs-example-navbar-collapse-1 a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top 
        }, 1000);
        return false;
      }
    }
  });
});
