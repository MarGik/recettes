<?php
    if(isset($_POST['bValiderAjoutProvenance'])) {
        if(isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['pays']) && !empty($_POST['pays'])) {
            $pays=$_POST['pays'];
            $rechercheidZ=mysqli_query($connexion,"SELECT idZ FROM ZONE_GEOGRAPHIQUE WHERE pays='".$pays."'");
            if($idZ=mysqli_fetch_row($rechercheidZ)) {
                $idZ=$idZ[0];
                $latitude=$_POST['latitude'];
                $longitude=$_POST['longitude'];
                $requeteAjoutLieu=mysqli_query($connexion,"INSERT INTO LIEU(latitude,longitude,idZ) VALUES($latitude,$longitude,$idZ)");
                $requeteIdL=mysqli_query($connexion,"SELECT LAST_INSERT_ID()");
                $idL=mysqli_fetch_row($requeteIdL)[0];
                $nomIng=$_POST['nomIng'];
                $rechercheidIng=mysqli_query($connexion,"SELECT idIng FROM INGREDIENT WHERE nomIngredient='$nomIng'");
                $idIng=mysqli_fetch_row($rechercheidIng)[0];
                $dateProvenance = new DateTime($_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour']);
                $requeteAjoutProvient=mysqli_query($connexion,"INSERT INTO PROVIENT(idIng,idL,dateProvenance) VALUES($idIng,$idL,'".$dateProvenance->format(MYSQL_DATE_FORMAT)."')");
                if($requeteAjoutProvient) {
                    echo "Ajout réussi.";
                }

                else {
                    echo "Erreur lors de l'ajout de provenance.";
                    
                }

            }

            else {
                echo "Erreur sur le pays, nous sommes désolé.";
                
            }
        }

        else {
            echo "Veuillez choisir un pays.";
            
        }

    }

    else {
?> 


    <script type="text/javascript" src="js/ajoutProvenance.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9HUnIUynWVqSRM6QxWLBHKnHqIbozjXQ&callback=initMap"></script> 
    <fieldset>
    <legend align="center">Ajout d'un lieu de provenance.</legend>
    <form name="formAjoutProvenance" method=post action="index.php?page=provient.php">
    <div style="width:100%; height:200px;">
        <table>
            <tr>
                <td><strong>Ingrédient :</strong></td>
                <td><?php selectIng(); ?></td>
            </tr>
            <tr>
                <td><strong>Date de provenance :</strong></td>
                <td><?php selectDate(); ?></td>
            </tr>
            <tr>
                <td>Pays :</td>
                <td><input type="text" id="pays" name="pays" value="Cliquez sur la carte." readonly="readonly"></td>
            </tr>
        </table>
    </div>
    <div id="map" style="width:100%; height:500px; margin-bottom: 20px;"></div>
    <input style="align-self: center" type="submit" name="bValiderAjoutProvenance" value="Valider">
    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">
    </form>
    </fieldset>


<?php
}
?>