


    <div id="map4" style="width:100%; height:300px;"></div>
    <script>
      var map;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map4'), {
          center: {lat:0, lng:0 },
          zoom: 8
        });


      <?php
            $pays=$_POST['Country'];
          $requeteA=mysqli_query($connexion,'SELECT provient .idIng FROM provient ;');

            $nbI=mysqli_field_count($connexion);
            while ($rowI=mysqli_fetch_array($requeteA,MYSQLI_NUM)) {
                for ($i=0; $i < $nbI ; $i++) {
                  $longituteX=mysqli_query($connexion,'SELECT lieu .longitude FROM lieu INNER JOIN provient on lieu .idL=provient .idL WHERE provient .idIng='.$rowI[$i].';');

                  $latitudeX=mysqli_query($connexion,'SELECT lieu .latitude FROM lieu INNER JOIN provient on lieu .idL=provient .idL WHERE provient .idIng='.$rowI[$i].';');
                  $nomI=mysqli_query($connexion,'SELECT ingredient .nomIngredient FROM ingredient WHERE ingredient .idIng='.$rowI[$i].';');
                  $idLieu=mysqli_query($connexion,'SELECT provient .idL FROM provient WHERE provient .idIng='.$rowI[$i].';');
                  $idLieuX=mysqli_fetch_row($idLieu);
                  $latX=mysqli_fetch_row($latitudeX);    
                  $longX=mysqli_fetch_row($longituteX);
                 $nomIX=mysqli_fetch_row($nomI);   
                  $paysX=mysqli_query($connexion,'SELECT zone_geographique .idZ FROM zone_geographique WHERE zone_geographique .pays LIKE \'%'.$pays.'%\';');
                  $paysXV=mysqli_fetch_row($paysX);
    
                 $idPidL=mysqli_query($connexion,'SELECT lieu .idL FROM lieu WHERE lieu .idZ='.$paysXV[0].';');
                 $contidP=mysqli_field_count($connexion);
                while($ro2=mysqli_fetch_array($idPidL,MYSQLI_NUM)){
                    for ($k=0; $k < $contidP ; $k++) {


                        if(1.0*$idLieuX[0]==1.0*$ro2[$k]){
                        echo ' var infowindow = new google.maps.InfoWindow({';
                              echo "content:'Ingredient: ";
                                    echo $nomIX[0];
                                    echo "',";
                              echo 'position: {lat: '.$latX[0].', lng: '.$longX[0].' },';
                            echo '  });';
                    echo ' infowindow.open(map);';

                  }}}

                      }




            }
      ?>


      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQjim3Sht-K90w6geMsSaSfAH_ff7gTG4&callback=initMap">
    </script>
