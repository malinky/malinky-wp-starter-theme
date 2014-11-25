jQuery(document).ready(function($){

    /*
     * Mobile navigation.
     * Ensure mobile nav is always hidden when back / forward cache is used. 
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


    /*
     * Toggle mobile navigation.
     */
    $('.mobile_navigation_navicon').click(function() {

        $('.mobile_navigation').toggleClass('mobile_navigation_show');
        $('body').toggleClass('mobile_navigation_show_body');

        event.preventDefault();

    });


    /*
     * IE Issues.
     */
    if ($('html').hasClass('lt-ie9')) {  
    
    };

    if ($('html').hasClass('lt-ie10')) {  
    
    };


    /*
     * Scroll to top.
     */    
    $("#back_top").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#back_top').fadeIn();
        } else {
            $('#back_top').fadeOut();
        }
    });


    /*
     * Scroll body to 0.
     */
    $('.back_top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });
        

    /*
     * Internal scroll to.
     */         
    $('.int_scroll').click(function () {
        var e = $(this).attr('href');
        $('body,html').animate({
            scrollTop: $(e).offset().top-70
        }, 600);
        return false;
    });

});