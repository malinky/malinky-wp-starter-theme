jQuery(document).ready(function($){

    /*
     * Mobile Navigation
     * Ensure mobile nav is always hidden when back / forward cache is used  
     */
    function pageShown(evt)
    {
        if (evt.persisted) {

            $('.mobile_navigation').hide();

        }
    }

    if(window.addEventListener) {

      window.addEventListener("pageshow", pageShown, false);

    } else {

      window.attachEvent("pageshow", pageShown, false);

    }

    $('.mobile_navigation_navicon').click(function() {

        $('.mobile_navigation').toggleClass('mobile_navigation_show');
        $('body').toggleClass('mobile_navigation_show_body');

        event.preventDefault();

    });

    /*-----IE 7/8-----*/
    //if ($('html').hasClass('lt-ie10')) {  
    //};
            
    /*-----NO CSS3 TRANSITIONS-----*/ 
    //if (!Modernizr.csstransitions) {
    //};
      
    /*-----FOOTER SCROLL TO TOP-----*/      
    /*$("#back_top").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#back_top').fadeIn();
        } else {
            $('#back_top').fadeOut();
        }
    });*/

    // scroll body to 0px on click
    $('.back_top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });
        
    /*-----INTERNAL LINKS SCROLL TO-----*/            
    $('.int_scroll').click(function () {
        var e = $(this).attr('href');
        $('body,html').animate({
            scrollTop: $(e).offset().top-70
        }, 600);
        return false;
    });

    /*-----INTERNAL LINKS SCROLL TO HOME -70 FOR NAV-----*/            
    $('.home_scroll, .home_scroll_first, .home_scroll a').click(function () {
        var e = $(this).attr('href');
        $('body,html').animate({
            scrollTop: $(e).offset().top-70
        }, 600);
        return false;
    });

});