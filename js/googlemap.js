/**
 * Load Google maps API.
 */    
function malinky_initialize()
{
    // If not map-canvas element.
    if ( ! document.getElementById( 'malinky-map-canvas' ) ) return;

    var mapOptions = {
        center: {
            lat: parseFloat( google_map_settings[0].lat ), 
            lng: parseFloat( google_map_settings[0].long ) 
        },
        zoom: parseFloat( google_map_settings.zoom ),
        scrollwheel: false,
    };

    var map = new google.maps.Map( document.getElementById( 'malinky-map-canvas' ), mapOptions );

    var key;
    var markers = [];
    var infoWindows = [];

    for ( var key in google_map_settings ) {

        /*
         * Only get numerical keys which will be those containing a location.
         */
        if ( ! isNaN( key ) ) {

            /*
             * Markers.
             */ 
             markers[key] = new google.maps.Marker({
                position: new google.maps.LatLng( parseFloat( google_map_settings[key].lat ), parseFloat( google_map_settings[key].long ) ),
                map: map,
            });

            /*
             * Create info windows if the addresses are set.
             */
            if ( google_map_settings[key].address_label != '' ) {

                infoWindows[key] = new google.maps.InfoWindow( {
                    content:    '<div class="malinky-map-info-window">' + 
                                google_map_settings[key].address_label + 
                                '</div>'
                });

                google.maps.event.addListener( markers[key], 'click', function( closureKey ) {
                    return function() {
                        //Close all infowindows.
                        for ( var x = 0; x < infoWindows.length; x++ ) {
                            infoWindows[x].close();
                        }
                        //Open new infowindow.
                        infoWindows[closureKey].open( map, markers[closureKey] );
                    }
                }(key));

                /*
                 * If address label is to be shown on first load.
                 */
                if ( google_map_settings[key].show_address_label ) {
                    infoWindows[key].open( map, markers[key] );
                }

            }

        }

    }

    /*
     * Center on resize.
     */
    google.maps.event.addDomListener( window, 'resize', function() {
        var center = map.getCenter();
        google.maps.event.trigger( map, 'resize' );
        map.setCenter( center );
    });
    
}
