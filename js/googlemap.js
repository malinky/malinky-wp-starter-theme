/**
 * Load Google maps API.
 */    
function malinky_initialize()
{

    //If not map-canvas element.
    if (!document.getElementById('map-canvas')) return;

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

    if (google_map_settings.show_address_label == true) {

        //Reopen info window when marker is clicked.
        google.maps.event.addDomListener(marker, "click", function() {
            infowindow.open(map, marker);
        })

        /*
         * Info window.
         */
        var contentString = '<div style="width: 180px; padding-right: 10px; font-size: 13px;">' + google_map_settings.address_label + '</div>';
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