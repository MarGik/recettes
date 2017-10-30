


    <div id="map" style="width:50%; height:300px;"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php  echo  $_GET['latitudeVal']; ?>, lng: <?php  echo $_GET['longitudeVal']; ?>},
          zoom: 8
        });

        var infowindow = new google.maps.InfoWindow({
    content: <?php echo '"'.$_GET['nomIngre'].'"';?>});

      var marker = new google.maps.Marker({
        position: {lat: <?php  echo  $_GET['latitudeVal']; ?>, lng: <?php  echo $_GET['longitudeVal']; ?>},
        map: map,
        title: 'Uluru (Ayers Rock)'
      });

      marker.addListener('click', function() {
          infowindow.open(map, marker);
        });








      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQjim3Sht-K90w6geMsSaSfAH_ff7gTG4&callback=initMap"
    async defer></script>
