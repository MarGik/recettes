<?php
	if(!isset($_SESSION["pseudo"])) { ?>
		<em>Vous êtes déjà connecté, voulez vous vous déconnecter ?<em>
		<a href = 'index.php/page=deconnexion.php'>Déconnexion</a>
	<?php 
	}

	else {
		$pseudo=$_SESSION["pseudo"];
		$idU=$_SESSION['idU'];
		$requeteInfos=mysqli_query($connexion,"SELECT * FROM UTILISATEUR WHERE idU=".$idU);          //requêtes 'Informations'
		$infos=mysqli_fetch_assoc($requeteInfos);
		$nom=(empty($infos["nom"]))? "NC":$infos["nom"];
		$prenom=(empty($infos["prenom"]))? "NC":$infos["prenom"];
		$dateNaissance=(empty($infos["dateNaissance"]))? "NC":$infos["dateNaissance"];
		$dateInscription=(empty($infos["dateInscription"]))? "NC":$infos["dateInscription"];
		$mail=(empty($infos["mail"]))? "NC":$infos["mail"];

		$dateNaissance=convertDateToSlash($dateNaissance);
		$dateInscription=convertDateToSlash($dateInscription);
?>

<fieldset id="monCompte">
<legend align="center"><h1>Informations :</h1></legend>
	<table width="50%">
		<tr align="center">
			<td><strong>Nom :</strong></td>
			<td><em><?php echo $nom; ?></em></td>
		</tr>
		<tr align="center">
			<td><strong>Prenom :</strong></td>
			<td><em><?php echo $prenom; ?></em></td>
		</tr>
		<tr align="center">
			<td><strong>Date de naissance :</strong></td>
			<td><em><?php echo $dateNaissance; ?></em></td>
		</tr>
		<tr align="center">
			<td><strong>Mail :</strong></td>
			<td><em><?php echo $mail; ?></em></td>
		</tr>
		<tr align="center">
			<td><strong>Date d'inscription :</strong></td>
			<td><em><?php echo $dateInscription; ?></em></td>
		</tr>
	</table>
</fieldset>

<?php 
}
?>