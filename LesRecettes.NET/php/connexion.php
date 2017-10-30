<?php
	if(isset($_SESSION["pseudo"])) { ?>
		<em>Vous êtes déjà connecté, voulez vous vous déconnecter ?<em>
		<a href = 'index.php/page=deconnexion.php'>Déconnexion</a>
	<?php 
	}

	else { 
		$validation = FALSE;
		if (isset($_POST['bValider'])) {
			if(isset($_POST['pseudo']) && isset($_POST['mdp'])) {
				$pseudo = mysqli_real_escape_string($connexion,$_POST['pseudo']);
				$mdp = mysqli_real_escape_string($connexion,$_POST['mdp']);
				$testRequete = mysqli_query($connexion,'SELECT idU,genre FROM UTILISATEUR WHERE pseudo=\''.$pseudo.'\' AND mdp=\''.$mdp.'\';');

				if ($testRequete && !empty($resultatsRequete=mysqli_fetch_assoc($testRequete))) {
					$_SESSION['pseudo'] = $pseudo;
					$_SESSION['idU'] = $resultatsRequete["idU"];  //mysqli_fetch_row($requete)[0];
					$_SESSION['genre'] = $resultatsRequete["genre"];
					header('Location:index.php?page=pageConnecte.php');
					
				}
				else {
					echo 'Utilisateur ou mot de passe inconnu, veuillez réessayer ou vous inscire <a href="index.php?page=inscription.php"> ici</a>';
				}
			}
		}
		else { ?>
			<fieldset>
			<legend id="leg" align="center">Connexion</legend>
				<form name="connexion" method=post action="index.php?page=connexion.php">
				<table width = "100%">
				<tr>
					<td><label for="idPseudo">Pseudo : </label></td>
					<td><input type="text" name="pseudo" id="idPseudo" /></td>
				</tr>
				<tr>
					<td><label for="idMdp">Mot de passe : </label></td>
					<td><input type="password" name="mdp" id="idMdp"/></td>
				</tr>
				<tr style="text-align:center;">
					<td colspan=2><br/><br/><input type="submit" name="bValider" value="Valider"/></td>
				</tr></table>
				</form>
			</fieldset>
		<?php 
		}
	}?>

	