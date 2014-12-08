/**
 * Load Google maps API.
 */    
function malinky_initialize()
{

    var mapOptions = {
        center: { lat: 52.921938, lng: -0.607490 },
        zoom: 14,
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

    /*
     * Center on resize.
     */
    google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center); 
    });
    
}
//google.maps.event.addDomListener(window, 'load', initialize);