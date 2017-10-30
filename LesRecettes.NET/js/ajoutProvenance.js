var marker;
function initMap() { //fonction appelée lors du chargement de l'API google
    var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
                animation: google.maps.Animation.DROP,
                center: {lat: 0, lng: 0 }
            });

            map.addListener('click', function(e) {
                placeOneMarkerAndPanTo(e.latLng, map);
          
            });

}

function getCountry(latLng){ //Fonction qui trouve le pays à partir de latLng et le place dans une valeur d'input
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latLng }, function (results, status) {
        var locItemCount = results.length;
        var locCountryNameCount = locItemCount - 1;
        var locCountryName = results[locCountryNameCount].formatted_address;
        document.getElementById("pays").value=locCountryName;
    });
}

function placeOneMarkerAndPanTo(latLng, map) { //Fonction qui place un marqueur s'il n'en existe pas et qui actualise sa position sinon
            
    if(!marker || !marker.setPosition) {
            marker = new google.maps.Marker({
            position: latLng,
            map: map
        });
    }
    else {
        marker.setPosition(latLng);
    }
    map.panTo(latLng);
    getCountry(latLng);
    var NewMapCenter = marker.getPosition();
    var latitude =NewMapCenter.lat();
    var longitude=NewMapCenter.lng();
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;

}