<?php
$validation = FALSE;
		if (isset($_POST['bValider'])) {
			if(isset($_POST['nomUser']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && !empty($_POST['nomUser'])) {
				$nomUser = mysqli_real_escape_string($connexion,$_POST['nomUser']);
				$mdp = mysqli_real_escape_string($connexion,$_POST['mdp']);
				$testUtilisateur = mysqli_query($connexion,'SELECT idU FROM UTILISATEUR WHERE pseudo=\''.$nomUser.'\'');
				if ($testUtilisateur && mysqli_fetch_row($testUtilisateur) != 0) {
					echo "Utilisateur existant, veuillez choisir un autre nom d'utilisateur";
				}
				else {
					$dateInscription = new DateTime();
					$dateNaissance = new DateTime($_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour']);
					$tab = ['mail','nom','prenom'];
					$requeteInscription1 = 'INSERT INTO UTILISATEUR (pseudo, mdp, genre,dateInscription,dateNaissance';//partie "nom attribut"
					$requeteInscription2 = ' VALUES ('.'\''.$nomUser.'\''.','.'\''.$mdp.'\''.','.'\''.$_POST['genre'].'\''.','.'\''.$dateInscription->format(MYSQL_DATE_FORMAT).'\''.','.'\''.$dateNaissance->format(MYSQL_DATE_FORMAT).'\''; //partie "valeur"
					foreach ($tab as $nomValeur) {
						if(isset($_POST[$nomValeur]) && !empty($_POST[$nomValeur])) {
							$valeur = mysqli_real_escape_string($connexion,$_POST[$nomValeur]);
							$requeteInscription1 .= ','.$nomValeur;
							$requeteInscription2 .= ','.'\''.$valeur.'\'';
						}
					}
					$requeteInscription = $requeteInscription1.')'.$requeteInscription2.')';
					if (mysqli_query($connexion,$requeteInscription)){
						echo "Votre inscription a été exécutée avec succès.";
					}
					else {
						echo "Erreur dans l'inscription.";
					}
				}
			}

			else {
				echo "Nom d'utilisateur ou mot de passe incorrects.";
			}
		}
		else { ?>
			<fieldset>
			<legend align="center">Inscription</legend>
				<form name="inscription" method=post action="index.php?page=inscription.php">
				<table width = "100%">
				<tr>
					<div>
						<strong style="color:red">*</strong>
						<em>: Champs obligatoires.</em>
					</div>	
				</tr>
				<tr>
					<td><label for="idNomUser">Identifiant : </label></td>
					<td><input type="text" name="nomUser" id="idNomUser" /><strong style="color:red"> *</strong></td>
				</tr>
				<tr>
					<td><label for="idMdp">Mot de passe : </label></td>
					<td><input type="password" name="mdp" id="idMdp"/><strong style="color:red"> *</strong></td>
				</tr>
				<tr>
					<td><label for="idMail">Mail : </label></td>
					<td><input type="text" name="mail" id="idMail"/></td>
				</tr>
				<tr>
					<td><label for="idNom">Nom : </label></td>
					<td><input type="text" name="nom" id="idNom"/></td>
				</tr>
				<tr>
					<td><label for="idPrenom">Prénom : </label></td>
					<td><input type="text" name="prenom" id="idPrenom"/></td>
				</tr>
				<tr>
					<td><label for="idGenre">Genre : </label></td>
					<td>
								M<input type="radio" name="genre" id = "idGenre" value="M"/>
								F<input type="radio" name="genre" value="F"/>
								NA<input type="radio" name="genre" checked="checked" value="NA"/></td>
				</tr>
				<tr>
					<td>
						<label for="idDate">Date de naissance : </label></td>
					<td>
						<?php selectDate(); ?>
					</td>
					
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="bValider" value="Valider"/></td>
				</tr>
				</table>
				</form>
			</fieldset>
		<?php 
		}