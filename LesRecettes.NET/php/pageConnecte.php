<?php
	echo 'Bonjour, '.$_SESSION['pseudo'].'. Ravi de vous revoir !';
	if(isset($_SESSION['genre'])) {
		if($_SESSION['genre'] == "F") {
			$message="Vous êtes maintenant connectée.";
		}
		else {
			$message="Vous êtes maintenant connecté.";
		}
	}
	echo $message;
?>