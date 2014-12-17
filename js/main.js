/* ------------------------------------------------------------------------ *
 * JavaScript
 * ------------------------------------------------------------------------ */

/**
 * Mobile navigation.
 * Ensure mobile nav is always hidden when back / forward cache is used. 
 */
function pageShown(evt)
{
    if (evt.persisted) {

        $('.mobile-navigation').hide();

    }
}

if(window.addEventListener) {

  window.addEventListener("pageshow", pageShown, false);

} else {

  window.attachEvent("pageshow", pageShown, false);

}





/* ------------------------------------------------------------------------ *
 * jQuery
 * ------------------------------------------------------------------------ */

jQuery(document).ready(function($){

    /*
     * Toggle mobile navigation.
     */
    $('#mobile-navigation-navicon').click(function(event) {

        $('.mobile-navigation').toggleClass('mobile-navigation-show');
        $('body').toggleClass('mobile-navigation-show-body');

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
     * Show fixed main navigation on scroll.
     * Scroll top should be no less than $navigation-height in SASS (120px).
     */    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 80) {
            $('.wrap--fixed').addClass('wrap--fixed--js-show');
            $('.wrap-full--full-fixed').addClass('wrap-full--full-fixed--js-show');
        } else {
            $('.wrap--fixed').removeClass('wrap--fixed--js-show');
            $('.wrap-full--full-fixed').removeClass('wrap-full--full-fixed--js-show');
        }
    });


    /*
     * Scroll to top.
     */    
    $(".back-top").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-top').fadeIn();
        } else {
            $('.back-top').fadeOut();
        }
    });


    /*
     * Scroll body to 0.
     */
    $('.back-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });
        

    /*
     * Internal scroll to.
     */         
    $('.int-scroll').click(function () {
        var e = $(this).attr('href');
        $('body,html').animate({
            scrollTop: $(e).offset().top-70
        }, 600);
        return false;
    });


    /*
     * SVG Fallback
     */
    if (!Modernizr.svg) {
        
        $("img").each(function() {
            var src = $(this).attr("src");
            $(this).attr("src", src.replace(/\.svg$/i, ".png"));
        });

    }    

});