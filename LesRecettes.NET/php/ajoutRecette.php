<!--		AJOUT DE RECETTES :
 -->
<?php 
	if(!isset($_SESSION['pseudo'])) {
		echo "Veuillez vous connecter.";
	}
	else {

		if(isset($_POST['bAjoutRecette'])){
			if(!empty($_POST['titre']) && !empty($_POST['nbPersonne']) && !empty($_POST['description']) && !empty($_POST['instruction1'])) {
				$titre=mysqli_real_escape_string($connexion,$_POST['titre']);
				$description=mysqli_real_escape_string($connexion,$_POST['description']);
				$reqRecette="INSERT INTO recette (titre,nbPersonne,description,categorie) VALUES ('".$titre."',".$_POST['nbPersonne'].",'".$description."','".$_POST['categorie']."')";
				if(mysqli_query($connexion,$reqRecette)){
				
				//Récupération de l'id de la recette en cours d'ajout
					$resultID=mysqli_query($connexion,"SELECT LAST_INSERT_ID()");
					$idR=mysqli_fetch_row($resultID)[0];
					mysqli_free_result($resultID);
					$dateCur = new Datetime();
					$dateCur = $dateCur->format(MYSQL_DATE_FORMAT);
					$idU = $_SESSION["idU"];
					$requeteProposition = "INSERT INTO PROPOSE (dateProposition,idR,idU) VALUES ('".$dateCur."', ".$idR.", ".$idU.")";
					if (mysqli_query($connexion,$requeteProposition)) {

						$tableauIngredient=tableauCreation("ingredient","quantiteIng","valeurUniteIng");
						$tableauProduit=tableauCreation("produit","quantiteProduit","valeurUniteProduit");
						requeteNecessiteIngredient($tableauIngredient,$idR);
						requeteNecessiteProduit($tableauProduit,$idR);
						$tableauEtape=tableauEtapeCreation();//Récupération dans $tableauEtape de chaque $tableauEtapeI contenant les instructions et ustensiles de l'étape i
						$reqpEtape="INSERT INTO etape (numero,instructions,idR) VALUES (?,?,?)";
						$prepaEtape=mysqli_prepare($connexion,$reqpEtape);
						$reqpRechercheUstensile="SELECT * FROM ustensile WHERE nom=?";
						$prepaRechercheUstensile=mysqli_prepare($connexion,$reqpRechercheUstensile);
					//execution des requêtes d'ajout d'étapes et d'ustensiles (si l'ustensile n'existe pas)
						$i=0;
						foreach ($tableauEtape as $etape) {
							$i+=1;
							$instruction=mysqli_real_escape_string($connexion,$etape[0]);
							mysqli_stmt_bind_param($prepaEtape,'iss',$i,$instruction,$idR);
							mysqli_execute($prepaEtape);
							$ustensile=explode(';',$etape[1]); //Séparation de la chaine "ustensile1;ustensile2.."en tableau ["ustensile1","ustensile2"]
							foreach ($ustensile as $nomUstensile) { 
								if(!empty($nomUstensile)) {
									$nomUstensile=ucfirst(strtolower(mysqli_real_escape_string($connexion,$nomUstensile)));
									mysqli_stmt_bind_param($prepaRechercheUstensile,'s',$nomUstensile);
									mysqli_execute($prepaRechercheUstensile);
									mysqli_stmt_bind_result($prepaRechercheUstensile,$resultat);
									mysqli_stmt_fetch($prepaRechercheUstensile);
									if (empty($resultat)){
										$nomUstensile=mysqli_real_escape_string($connexion,$nomUstensile);
										$requete="INSERT INTO ustensile (nom) VALUES ('".$nomUstensile."')";
										mysqli_query($connexion,$requete);
									}
									$rechercheUstensile="SELECT * FROM NECESSITE_USTENSILE WHERE nom ='".$nomUstensile."' AND numero='".$i."' AND idR='".$idR."'";
									$requeteRecherche=mysqli_query($connexion,$rechercheUstensile);
									if ( $requeteRecherche && mysqli_fetch_row($requeteRecherche)==0) {
										
										$requeteNecessiteUstensile="INSERT INTO NECESSITE_USTENSILE (nom,numero,idR) VALUES ('".$nomUstensile."', '".$i."', '".$idR."')";
										if(!mysqli_query($connexion,$requeteNecessiteUstensile)){
											echo "Erreur lors de l'ajout des ustensiles";
											exit();
										}
									}
								}	
							}
						}

						echo "Recette ajoutée avec succès.";
					}

					else {
						echo "Erreur lors de l'ajout de la proposition";
					}
				}

				else {
					echo "Erreur lors de l'ajout de la recette";
				}
			}

			else {
				echo "Veuillez entrer au moins un titre, un nombre de personnes, une description et une instruction.";
			}
		}
		else {
			$optionUnite = option("SELECT * FROM UNITE");
			$optionIngredient = option("SELECT nomIngredient FROM INGREDIENT GROUP BY nomIngredient");
			$optionProduit = option("SELECT nomProduit FROM PRODUIT GROUP BY nomProduit");
			
		?>

<fieldset class="fieldset1">
<legend align="center">Ajout d'une recette</legend>
	<form name="ajoutRecette" method=post action="index.php?page=ajoutRecette.php">
		<table width = "100%" id="tableauRecette">
			<tr>
				<td><label for="idTitre"><strong>Titre</strong> : </label></td>
				<td><input style="width: 400px;" type="text" name="titre" id="idTitre" /></td>
			</tr>
			<tr>
				<td><label for="idCategorie"><strong>Catégorie</strong> : </label></td>
				<td><select name="categorie"><option>Entrée<option>Plat<option>Dessert</select></td>
			</tr>
			<tr>
				<td><label for="idNbPersonne"><strong>Nombre de personnes</strong> : </label></td>
				<td><input type="number" min="1" name="nbPersonne" id="idNbPersonne"/></td>
			</tr>
			<tr>
				<td><label for="idDescription"><strong>Description</strong> : </label></td>
				<td><textarea name="description" cols="60" rows="5" ></textarea></td>	
			</tr>
			<tr> 
				<td><strong>Ingrédients :</strong> <span id="idLienIngredient" style="cursor:pointer">+</span></td>
			</tr>
			<tr info=1 class="classIng">
				<td>	
					<label><strong>1.</strong></label>
					<select name="ingredient1"><?php echo $optionIngredient; ?></select>
					<label><strong>Quantité: </strong></label>
					<input type="number" min='0' name="quantiteIng1" />
					<select name="valeurUniteIng1"><?php echo $optionUnite; ?></select>
				</td>
			</tr>
			<tr> 
				<td><strong>Produits :</strong> <span id="idLienProduit" style="cursor:pointer">+</span></td>
			</tr>
			<tr info=1 class="classProduit">
				<td>	
					<label><strong>1.</strong></label>
					<select name="produit1"><?php echo $optionProduit; ?></select>
					<label><strong>Quantité: </strong></label>
					<input type="number" min='0' name="quantiteProduit1" />
					<select name="valeurUniteProduit1"><?php echo $optionUnite; ?></select>
				</td>
			</tr>
			
			<tr>
				<td><strong>Etapes :</strong> <span id="idLienEtape" style="cursor:pointer">+</span></td>
				<td><em>(veuillez séparer vos ustensiles avec des points virgules)</em></td>
			</tr>
			<tr class='trEtape'>
				<td class="tdAttributEtape"><label><strong>1.</strong>1 Instructions:</label></br><label><strong>1.</strong>2 Ustensiles:</label></td>
				<td><textarea cols="60" rows="2" name="instruction1" info=1 ></textarea></br><input class='inputUstensile' type="text" name="ustensile1" info=1 /></td>
			</tr>
		</table>
		<input style="align-self: center;" type="submit" name="bAjoutRecette" value="Ajouter !">
</fieldset>
<input type="hidden" id="optionUnite" value="<?php echo $optionUnite; ?>"> <!-- VARIABLES JQUERY -->
<input type="hidden" id="optionIngredient" value="<?php echo $optionIngredient; ?>">
<input type="hidden" id="optionProduit" value="<?php echo $optionProduit; ?>">

<?php
}}?>
