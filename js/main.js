/**
 * Is high density screen.
 * Uses min-resoution and prefixes, then device pixel ratio.
 * Based on 1.3 ratio to css pixel.
 */
function isHighDensity() {
    return ((window.matchMedia && (window.matchMedia('only screen and (min-resolution: 124dpi), only screen and (min-resolution: 1.3dppx), only screen and (min-resolution: 48.8dpcm)').matches || window.matchMedia('only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (min-device-pixel-ratio: 1.3)').matches)) || (window.devicePixelRatio && window.devicePixelRatio > 1.3));
}

/**
 * Back forward nav issue ios.
 */
window.onpageshow = function(event) {
    if (event.persisted) {
        document.querySelector('.mobile-navigation').classList.remove('mobile-navigation-show');
        document.querySelector('#mobile-navigation-toggle-id').classList.add('collapsed');
    }
};

/* ------------------------------------------------------------------------ *
 * jQuery
 * ------------------------------------------------------------------------ */

jQuery(document).ready(function($){

    /*
     * Lazy load.
     * Hide grey background and use logo (added in css)
     */
    $("img.lazy").lazyload({
        placeholder: '',
        threshold : 400
    });

    /*
     * Mobile navigation function.
     */
    var mobileNavigation = function() {

        var toggleId = $('#mobile-navigation-toggle-id');

        $('.mobile-navigation-bar').toggleClass('mobile-navigation-bar--on');
        $('.mobile-navigation').toggleClass('mobile-navigation-show');
        
        $(toggleId).toggleClass('collapsed');

        if ($(toggleId).hasClass('collapsed')) {
            $(toggleId).attr('aria-expanded', false);
        } else {
            $(toggleId).attr('aria-expanded', true);
        }

    }

    /*
     * Toggle mobile navigation.
     */
    $('#mobile-navigation-toggle-id').click(function(event) {
        mobileNavigation();
        event.preventDefault();

    });

    /*
     * IE styles.
     */
    if ($('html').hasClass('lt-ie9')) {  
    }
    if ($('html').hasClass('lt-ie10')) {
    };

    /*
     * Show fixed main navigation on scroll.
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
     * Mobile sidebar.
     */              
    $('.sidebar-mobile a.widget-title').click(function(e) {
        //$(this).toggleClass('widget-title--open');
        $(this).toggleClass('collapsed');
        $('.sidebar-mobile-inside').toggle();

        if ($(this).hasClass('collapsed')) {
            $(this).attr('aria-expanded', false);
        } else {
            $(this).attr('aria-expanded', true);
        }
                
        e.preventDefault();
    });

    /*
     * Scroll to top.
     */    
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

     /**
     * malinkyHiDensitySwap
     *
     * If images are lazy loaded and on high density
     * then this script won't swap the src of the images below the fold that will be lazy loaded.
     * This is because the src attribute isn't available as the image url is in the data-original
     * attribute. In this case we actually swap the data-original attribute with the high density
     * url for the lazy load to swap that into the src when the page is scrolled.
     * The images above the fold are swapped through their src as lazy load runs before this.
     * 
     * @param  obj malinkyElem An jQuery element
     * @param  str malinkyAttr Attribute to swap
     * @param  regEx malinkyRegex
     * @param  str malinkyRegexReplace Replacement for regEx
     * @param  str malinkyLazyAttr Lazyload attribute to swap (optional)
     * @return void
     */
    function malinkyHiDensitySwap (malinkyElem, malinkyAttr, malinkyRegex, malinkyRegexReplace, malinkyLazyAttr) {
        var malinkyOriginal = malinkyElem.attr(malinkyAttr);
        malinkyRetina = malinkyOriginal.replace(malinkyRegex, malinkyRegexReplace);
        malinkyElem.attr(malinkyAttr, malinkyRetina);
        if (malinkyLazyAttr) {
            if (malinkyElem.attr(malinkyLazyAttr)) {
                malinkyOriginal = malinkyElem.attr(malinkyLazyAttr);  
                malinkyRetina = malinkyOriginal.replace(malinkyRegex, malinkyRegexReplace);
                malinkyElem.attr(malinkyLazyAttr, malinkyRetina);  
            }
        }
    }

});
