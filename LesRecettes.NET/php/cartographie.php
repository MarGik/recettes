<legend align="center" ><h2><strong> Veuillez choisir la façon de rechercher</strong></h2>  </legend>
<form name="radius50" method="post" action="index.php?page=radius50.php">
  <label for="map2">Tous les points autour d'une position :</labe>
    <div id="map2" style="width:100%; height:300px;"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map2'), {
          zoom: 4,
          animation: google.maps.Animation.DROP,
          center: {lat: 0, lng: 0 }
        });

        map.addListener('click', function(e) {
          placeMarkerAndPanTo(e.latLng, map);
        });

      }

      function placeMarkerAndPanTo(latLng, map) {
        var marker = new google.maps.Marker({
          position: latLng,
          map: map
        });
        map.panTo(latLng);
    var NewMapCenter = marker.getPosition();
    var UserLat =NewMapCenter.lat();
    var UserLong=NewMapCenter.lng();
    document.getElementById("lat1").value = UserLat;
    document.getElementById("long1").value = UserLong;
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQjim3Sht-K90w6geMsSaSfAH_ff7gTG4&callback=initMap">
    </script>
    <input type="hidden" name="la" id="lat1"/>
    <input type="hidden" name="lo" id="long1"/>
  Le rayon en KM
    <input type="text" name="rayon"/>
    <input type="submit" name="distance"  />
  </form>
</br>
</br>
<hr color="black"/>
  <legend align="center"></strong>Ingrédients produits par pays :</strong> </legend>
<form name="parPays" method="post" action="index.php?page=parPays.php" >
  <?php selectCountry(); ?>
<input type="submit" name="parpays"/>
</form>

