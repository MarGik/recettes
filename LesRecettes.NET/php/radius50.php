
<?php
function degRad ($deg){return $deg*(3.14159265359/180);}
function distance ($latOrigin, $longOrigin , $lat, $long){
  $R=6371;
  $dLat=degRad($lat-$latOrigin);
  $dLong=degRad($long-$longOrigin);
  $a = sin($dLat/2)*sin($dLat/2)+cos(degRad($latOrigin))*cos(degRad($lat))*sin($dLong/2)*sin($dLong/2);
  $c = 2*atan2(sqrt($a),sqrt(1-$a));
  $d=$R*$c;
  return $d;

}
 ?>



    <div id="map3" style="width:100%; height:300px;"></div>
    <script>
      var map;
      var latO = <?php  echo 1.0*$_POST['la']; ?>;
      var lngO = <?php  echo 1.0*$_POST['lo']; ?>;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map3'), {
          center: {lat:latO, lng:lngO },
          zoom: 8
        });

      var marker = new google.maps.Marker({

        position: {lat:latO, lng:lngO},
        map: map,
        title: 'Uluru (Ayers Rock)'
      });
      <?php
        $latO=1.0*$_POST['la'];
        
        $longO=1.0*$_POST['lo'];
        $distance=$_POST['rayon'];

        $requeteIdI=mysqli_query($connexion,'SELECT ingredient .nomIngredient,lieu .latitude ,lieu .longitude FROM ingredient INNER JOIN provient ON provient .idIng = ingredient .idIng INNER JOIN lieu on provient .idL = lieu .idL   ;');

    while ($row2=mysqli_fetch_row($requeteIdI)) {

              $longTest=1.0*$row2[2];
              $latTest=1.0*$row2[1];
              if(distance($latO,$longO,$latTest,$longTest)<=$distance ){
             echo '    var infowindow = new google.maps.InfoWindow({';
                   echo "content:'Ingredient: ";
                         echo $row2[0] ;
                         echo "',";
                   echo 'position: {lat: '.$row2[1].', lng: '.$row2[2].' },';
                 echo '  });';
         echo ' infowindow.open(map);';
               }
            }


        ?>

      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQjim3Sht-K90w6geMsSaSfAH_ff7gTG4&callback=initMap"
    async defer></script>
