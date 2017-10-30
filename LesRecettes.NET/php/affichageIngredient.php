<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9HUnIUynWVqSRM6QxWLBHKnHqIbozjXQ"></script>
<script src="js/affichageIng.js" type="text/javascript"></script>
<?php 
if(isset($_GET['tab']) && isset($_GET['nom'])) {
	
	$tab=unserialize($_GET['tab']); //recupération du tableau linéaire passé en GET et délinéarisation
	$nom=$_GET['nom'];
	echo "<h1 style='text-align :center;'>Ingrédient : $nom</h1><div id='map' style='width:100%; height:100%;'></div>";
	?>
	
	<script type='text/javascript'>
		var locations= <?php echo json_encode($tab); ?>;
		initMapMarker(locations);
	</script>

<?php
}
else {
	echo "Vous vous êtes perdus !";
}
?>