/**
 * Load Google maps API.
 */    
function malinky_initialize()
{

    console.log(google_map_settings);

    var mapOptions = {
        center: { lat: parseFloat(google_map_settings.lat), lng: parseFloat(google_map_settings.long) },
        zoom: parseFloat(google_map_settings.zoom),
        scrollwheel: false,
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    /*
     * Marker.
     */ 
    var marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
    });

    if (google_map_settings.show_address == true) {

        //Reopen info window when marker is clicked.
        google.maps.event.addDomListener(marker, "click", function() {
            infowindow.open(map, marker);
        })

        /*
         * Info window.
         */
        var contentString = '<div style="width: 210px; padding-right: 10px; font-size: 13px;">Print Bureau Team<br />3 Ruston Road<br />Grantham<br />Lincolnshire<br />NG31 9SW</div>';
        var infowindow = new google.maps.InfoWindow( {
            content: contentString
        });
        infowindow.open(map, marker);

    }

    /*
     * Center on resize.
     */
    google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center); 
    });
    
}