var map;

function initialize(lat, lng, name) {
    var latlng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        zoom: 16,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    var marker = new google.maps.Marker({
        map: map,
        title: name,
        position: latlng
    });
}
