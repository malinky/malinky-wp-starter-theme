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
 * Packery
 * ------------------------------------------------------------------------ */

/*
 * Load packery as used on turf installation photos page.
 * Used on wildflower turf wildlife gallery, wildlife gallery andturf production gallery
 */
var container = document.querySelector(".malinky-packery");
if (container) {
    var containerPackery = new Packery(container, {
        itemSelector: ".malinky-packery-item",
        gutter: ".malinky-packery__gutter",
        isInitLayout: false
    }).on("layoutComplete", function() {
          container.className += ' malinky-packery--loaded';
    });
    containerPackery.layout();
}


/* ------------------------------------------------------------------------ *
 * Photoswipe
 * ------------------------------------------------------------------------ */

var initPhotoSwipeFromDOM = function(gallerySelector) {

    /**
     * Loop through thumbnails and return items object.
     *
     * @return obj items
     */
    var parseThumbnailElements = function(el)
    {
    
        //var thumbElements = el.getElementsByTagName('a'),
        var thumbElements = el.querySelectorAll('a.malinky-photoswipe-image'),
            numNodes = thumbElements.length,
            items = [],
            divEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            /*
             * <div> wrapper around each thumbnail.
             */
            divEl = thumbElements[i].parentNode;

            /*
             * Include only element nodes.
             */
            if(divEl.nodeType !== 1) {
                continue;
            }

            /*
             * <a> containing link to large image and data-image-size-large.
             * Optional data-image-medium and data-image-size-medium.
             */
            linkEl = divEl.children[0];

            size = linkEl.getAttribute('data-image-size-large').split('x');

            /*
             * Create slide items object.
             */
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };

            /*
             * Get thumbnail url for loading before large image
             */
            if(linkEl.children.length > 0) {
                item.msrc = linkEl.children[0].getAttribute('src');
            } 

            /*
             * Create medium slide items object if data exists.
             */
            var mediumSrc = linkEl.getAttribute('data-image-medium');
            if(mediumSrc) {
                size = linkEl.getAttribute('data-image-size-medium').split('x');
                /*
                 * Medium image.
                 */
                item.m = {
                    src: mediumSrc,
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };
            }

            /*
             * Original image.
             */
            item.o = {
                src: item.src,
                w: item.w,
                h: item.h
            };

            /*
             * Set the caption if it has one.
             * HTML should be <meta itemprop="caption description" value="" />
             */
            if (linkEl.children[1]) {
                if (linkEl.children[1].hasAttribute('value')) {
                    item.title = linkEl.children[1].getAttribute('value');
                }
            }

            /*
             * Save for getThumbBoundsFn.
             */
            item.el = divEl;
            items.push(item);
        }

        return items;

    };


    /**
     * Find nearest parent element.
     *
     * @return element
     */
    var closest = function closest(el, fn)
    {

        return el && ( fn(el) ? el : closest(el.parentNode, fn) );

    };


    /**
     * Trigger when a thumbnail is clicked.
     *
     * @return void
     */
    var onThumbnailsClick = function(e)
    {

        e = e || window.event;
        var eTarget = e.target || e.srcElement;

        /*
         * Find if root element is a clicked overlay.
         */
        var clickedOverlay = closest(eTarget, function(el) {
            //return (el.tagName && el.tagName.toUpperCase() === 'DIV' && el.classList.contains('malinky-photoswipe-image-overlay'));
            //ie9 version.
            return (el.tagName && el.tagName.toUpperCase() === 'DIV' && el.className.indexOf('malinky-photoswipe-image-overlay') > -1);
        });

        if(clickedOverlay) {
            return;
        }

        /*
         * If no clicked overlay continue trying to open an image.
         */
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        /*
         * Find root element of clicked slide which is a div.
         */
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'DIV');
        });

        if(!clickedListItem) {
            return;
        }
        
        /*
         * Get clicked gallery nodes.
         */
        var clickedGallery = document.querySelector(gallerySelector),
            index;
            
        /*
         * Save index of the clicked thumbnail.
         */
        index = parseInt(clickedListItem.getAttribute('data-image-index'));

        /*
         * Open PhotoSwipe if valid index found.
         */
        if(index >= 0) {
            openPhotoSwipe( index, clickedGallery );
        }
        
        return false;

    };


    /**
     * Create Photoswipe instance.
     *
     * @return void
     */
    var openPhotoSwipe = function(index, galleryElement, disableAnimation)
    {

        /*
         * Append HTML to the body.
         */
        jQuery('body').append(galleryHtml);
        
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        /*
         * Loop through thumbnails and return items object.
         */
        items = parseThumbnailElements(galleryElement);
        
        /*
         * Define options.
         */
        options = {
            index: index,
            history: false,
            closeOnScroll: false,
            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect(); 

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                //return {x:0, y:0, w:rect.width};
            },
            shareButtons: [
                {id:'facebook', label:'Share on Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{image_url}}'},
                {id:'twitter', label:'Tweet', url:'https://twitter.com/intent/tweet?text={{text}}&url={{image_url}}'},
                {id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'},
                {id:'download', label:'Download image', url:'{{raw_image_url}}', download:true}
            ]
        };

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }


        /*
         * Pass data to PhotoSwipe. Don't initialize yet as need to set up responsive image swaps.
         */
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);


        /*
         * Reponsive image swapping
         * http://photoswipe.com/documentation/responsive-images.html
         */
        var realViewportWidth,
            useLargeImages = false,
            firstResize = true,
            imageSrcWillChange;

        gallery.listen('beforeResize', function() {

            var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
            dpiRatio = Math.min(dpiRatio, 2.5);
            realViewportWidth = gallery.viewportSize.x * dpiRatio;

            /*
             * First condition is for retina mobiles, potentially 2 pixel density 600px wide so 1200px.
             * Other conditions pretty much show large images on computer size screens.
             * May require some tweaking.
             */
            if(realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200 ) {
                if(!useLargeImages) {
                    useLargeImages = true;
                    imageSrcWillChange = true;
                }
                
            } else {
                if(useLargeImages) {
                    useLargeImages = false;
                    imageSrcWillChange = true;
                }
            }

            /*
             * imageSrcWillChange needs to be true.
             * firstResize needs to be false.
             */
            if(imageSrcWillChange && !firstResize) {
                gallery.invalidateCurrItems();
            }

            if(firstResize) {
                firstResize = false;
            }

            imageSrcWillChange = false;

        });

        gallery.listen('gettingData', function(index, item) {
            if( useLargeImages ) {
                item.src = item.o.src;
                item.w = item.o.w;
                item.h = item.o.h;
            } else {
                item.src = item.m.src;
                item.w = item.m.w;
                item.h = item.m.h;
            }
        });


        /*
         * Initialize Photoswipe.
         */        
        gallery.init();


        /*
         * Debug responsive.
         */
        //console.log(window.devicePixelRatio);
        //console.log('realViewportWidth ' + gallery.viewportSize.x * Math.min(window.devicePixelRatio, 2.5));

    };


    /*
     * Loop through all thumbnails and bind events.
     */
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }


    /*
     * The block of HTML to add in openPhotoSwipe function.
     */
     var galleryHtml = '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"><div class="pswp__bg"></div><div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div> </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div>';

};

/**
 * Using the class .malinky-gallery just triggers any images within that div to use photoswipe.
 * Both holding divs should hold the equivalent #malinky-gallery-x (where x is a number).
 */

/*
 * Get all galleries.
 */
var malinkyGallery = document.querySelectorAll('.malinky-gallery');

/*
 * Execute Photoswipe function for each gallery.
 */
for (x = 0; x < malinkyGallery.length; x++) {
    initPhotoSwipeFromDOM('#' + malinkyGallery[x].id);
}


/* ------------------------------------------------------------------------ *
 * jQuery
 * ------------------------------------------------------------------------ */

jQuery(document).ready(function($){

    /*
     * Lazy load.
     * Hide grey background and use MM logo (added in css)
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


    if ($('html').hasClass('lt-ie9')) {  
    }
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


    imagesLoaded(window, function() {
        if (isHighDensity()) {
            $('.malinky-packery-item__inner__img').each(function(index) {
                if ($(this).attr('data-original-malinky') == 'malinky_portrait') {
                    malinkyHiDensitySwap($(this), 'src', /-(\d)+x(\d)+/i, '-600x900', 'data-original');
                } else {
                    malinkyHiDensitySwap($(this), 'src', /-(\d)+x(\d)+/i, '-600x440', 'data-original');
                }
            });
        }
    });

});
