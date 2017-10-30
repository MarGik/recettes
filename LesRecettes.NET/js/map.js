     			function initMap() {
       				var map = new google.maps.Map(document.getElementById('map2'), {
       				   zoom: 2,
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

      initMap();
      placeMarkerAndPanTo();
