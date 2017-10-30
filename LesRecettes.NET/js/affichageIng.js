/* Fonction qui crée la carte à partir d'un array 'locations' (contenant les lat et long des marqueurs) */
function initMapMarker(locations) {
    var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
                animation: google.maps.Animation.DROP,
                center: {lat: 0, lng: 0 }
            });


    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  //Pour chaque ligne du tableau, on crée le marqueur correspondant
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][0], locations[i][1]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infowindow.setContent("Date de provenance :</br><em>"+locations[i][2]+"</em>"); //on ajoute une infowindow contenant la date de Provenance
            infowindow.open(map, marker);
        }
      })(marker, i));
    
    }

}
