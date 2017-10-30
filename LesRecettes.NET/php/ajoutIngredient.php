<?php 
	if(!isset($_SESSION['pseudo'])) {
		echo "Veuillez vous connecter.";
	}

		elseif(isset($_POST['bAjoutIngredient'])) {
			if (isset($_POST['nomIng']) && !empty($_POST['nomIng'])) {
				$nomIng =mysqli_real_escape_string($connexion,$_POST['nomIng']);
				$nomIng=ucfirst(strtolower($nomIng)); //uniformisation des noms (Première lettre maj et reste min)
				$categorie = $_POST['categorie'];
				$testExistence=mysqli_query($connexion,"SELECT * FROM INGREDIENT WHERE nomIngredient='".$nomIng."'");
				if(!empty(mysqli_fetch_row($testExistence))) {
					echo "Ingrédient '$nomIng' déjà existant.";
					exit();
				}
				$requeteAjout=mysqli_query($connexion,"INSERT INTO INGREDIENT (nomIngredient,categorie) VALUES ('".$nomIng."', '".$categorie."')");
				if($requeteAjout) {
					echo "Ajout de l'ingrédient '$nomIng' réussi.";
				}

			}

			else {
				echo "Veuillez choisir un nom d'ingrédient.";
			}
		}
		
		else {	?>

	<fieldset>
	<legend align="center">Ajout d'un ingrédient</legend>
		<form name="AjoutIngredient" method="post" action="index.php?page=AjoutIngredient.php">
			<table width = "100%">
				<tr>
					<td><label for="idNomIng"><strong>Nom : </strong></label></td>
					<td><input type="text" name="nomIng" id="idNomIng" /></td>
				</tr>
				<tr>
					<td><label for="idCategorie"><strong>Catégorie : </strong></label></td>
					<td><select id="idCategorie" name="categorie"><option>Légume<option>Epice<option>Fruit<option>Poisson/Crustacé<option>Viande</select></td>
				</tr>
			</table>
			<input style="align-self: center;" type="submit" name="bAjoutIngredient" value="Ajouter !">
			<script type="text/javascript" src="js/map.js"></script>
		</form>
	</fieldset>

<?php 
}
?>
