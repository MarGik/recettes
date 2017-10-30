<?php 

$connexionBaseIntegration = mysqli_connect("localhost", "root", "", "BD_sources");
if (mysqli_connect_errno()) {
	printf("Échec de la connexion : %s\n", mysqli_connect_error());
	exit();
}
mysqli_query($connexionBaseIntegration,"SET NAMES utf8");

$connexion = mysqli_connect("localhost", "root", "", "recetteRevue2");
if (mysqli_connect_errno()) {
    printf("Échec de la connexion : %s\n", mysqli_connect_error());
   exit();
}
mysqli_query($connexion,"SET NAMES utf8");

ini_set('max_execution_time', 9000);
$requetePays=mysqli_query($connexionBaseIntegration,"SELECT codePays,nom,continent FROM PaysBDW1");
$resultatsPays=mysqli_fetch_all($requetePays,MYSQLI_ASSOC);
mysqli_free_result($requetePays);
foreach ($resultatsPays as $pays) {
	echo $pays['nom'];
	switch ($pays['continent']) {
		case "AS" :
			$continent="Asie";
			break;
		case "AF" :
			$continent="Afrique";
			break;

		case "EU" :
			$continent="Europe";
			break;

		case "NA" :
			$continent="Amérique du Nord";
			break;

		case "AN" :
			$continent="Antarctique";
			break;

		case "SA" :
			$continent="Amérique du Sud";
			break;

		case "OC" :
			$continent="Océanie";
			break;
	}
	$reqAjoutZG="INSERT INTO ZONE_GEOGRAPHIQUE(pays,continent) VALUES('".$pays['nom']."', '".$continent."')";
	if(!mysqli_query($connexion,$reqAjoutZG)) {
		echo $reqAjoutZG;
	}
	$requeteIdZ=mysqli_query($connexion,"SELECT LAST_INSERT_ID()");
	$idZ=mysqli_fetch_row($requeteIdZ)[0];
	$requete="SELECT id,latitude,longitude FROM LieuxBDW1 WHERE codePays='".$pays['codePays']."'";
	$requeteLieu=mysqli_query($connexionBaseIntegration,$requete);
	$resultatsLieu=mysqli_fetch_all($requeteLieu,MYSQLI_ASSOC);
	mysqli_free_result($requeteLieu);
	foreach ($resultatsLieu as $lieu) {
		$reqAjoutLieu="INSERT INTO LIEU(latitude,longitude,idZ) VALUES('".$lieu['latitude']."','".$lieu['longitude']."',$idZ)";
		if(mysqli_query($connexion,$reqAjoutLieu)){
		}
		$requeteIdL=mysqli_query($connexion,"SELECT LAST_INSERT_ID()");
		$idL=mysqli_fetch_row($requeteIdL)[0];
		$requete="SELECT emailAdresse,nom,prenom,sexe,dateNaissance,adresse,codePostal,pays,ville FROM PersonnesBDW1 WHERE geonameid=".$lieu['id']."";
		if($requetePersonne=mysqli_query($connexionBaseIntegration,$requete)) {
		}
		$resultatsPersonne=mysqli_fetch_all($requetePersonne,MYSQLI_ASSOC);
		mysqli_free_result($requetePersonne);
		if(empty($resultatsPersonne)) {
			continue;
		}
		foreach ($resultatsPersonne as $personne) {
			echo $personne['adresse'];
			$dateBase=$personne['dateNaissance'];
			$dateNaissanceStr=explode("/",$dateBase);
			$dateNaissance=$dateNaissanceStr[2]."/".$dateNaissanceStr[0]."/".$dateNaissanceStr[1];
			$dateInscription = new DateTime();
			echo "dans personne!";
			$dateInscription=$dateInscription->format("Y-m-d");
			$pseudo=str_shuffle($personne['prenom']);
			$pseudo=preg_replace('/[^A-Za-z0-9\-]/', '', $pseudo);
			$rechercheExistencePseudo=mysqli_query($connexion,"SELECT * FROM UTILISATEUR WHERE pseudo='$pseudo'");
			echo $pseudo;
			if(!empty(mysqli_fetch_row($rechercheExistencePseudo))) {
				$pseudo.=str_shuffle($personne['nom']);
			}
			$mdp=str_replace("/", "", $personne["dateNaissance"]);
			$requeteAjoutUtilisateur="INSERT INTO UTILISATEUR(nom,prenom,dateNaissance,genre,mail,dateInscription,mdp,pseudo,idL) VALUES (\"".$personne['nom']."\", \"".$personne['prenom']."\", '$dateNaissance', '".$personne['sexe']."', '".$personne['emailAdresse']."', '$dateInscription', $mdp, \"".$pseudo."\", $idL)";
			if(!mysqli_query($connexion,$requeteAjoutUtilisateur)) {
				echo $requeteAjoutUtilisateur;
				exit();
			}
			$requeteIdU=mysqli_query($connexion,"SELECT LAST_INSERT_ID()");
			$idU=mysqli_fetch_row($requeteIdU)[0];
			$requeteAjoutAdresse="INSERT INTO ADRESSE(pays,ville,codePostal,adresse,idL,idU) VALUES('".$personne['pays']."', \"".$personne['ville']."\", '".$personne['codePostal']."', \"".$personne['adresse']."\", $idL, $idU) ";
			if(!mysqli_query($connexion,$requeteAjoutAdresse)) {
				echo $requeteAjoutAdresse;
				exit();
			}

		}

	}
}
mysqli_close($connexionBaseIntegration);





?>

