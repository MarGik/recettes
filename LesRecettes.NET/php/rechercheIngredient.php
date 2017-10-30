<?php
	if(isset($_POST["bValiderRechercheIngredient"])) {
		if($_POST["choixTri"] == "categorie") { $tri="categorie"; }
		else { $tri="nomIngredient"; }
		$recherche=mysqli_real_escape_string($connexion,$_POST["nomIngredient"]);
		if(empty($recherche)) {
			$requete = "SELECT nomIngredient,categorie,idIng FROM INGREDIENT ORDER BY ".$tri;
		}
		else {
			$requete = "SELECT nomIngredient,categorie,idIng FROM INGREDIENT WHERE nomIngredient LIKE '".$recherche."%' ORDER BY ".$tri;
		}
		if ($requeteExec=mysqli_query($connexion,$requete)) {
			$entete="<div class='divLegendIng'><h1 class='titresIng'>Nom :</h1><h1 class='titresIng'>Categorie :</h1></div>";
			$html="";
			while($ligne=mysqli_fetch_row($requeteExec)) {
				$requeteProvient="SELECT latitude,longitude,dateProvenance FROM PROVIENT NATURAL JOIN LIEU WHERE idIng=$ligne[2]";
				$execProvient=mysqli_query($connexion,$requeteProvient);
				$tab=mysqli_fetch_all($execProvient);
				$length=count($tab);
				for($i=0;$i<$length;$i++) {
					$dateConverted=convertDateToSlash($tab[$i][2]);
					$tab[$i][2]=$dateConverted;
				}
				$tabLineaire=serialize($tab);
				$html.="<a href='index.php?page=affichageIngredient.php&nom=".$ligne[0]."&categorie=".$ligne[1]."&tab=".$tabLineaire."' class='divIngredient'><em class='valeursIng'>".$ligne[0]."</em><em class='valeursIng'>".$ligne[1]."</em></a>";
			}

			if (empty($html)) { echo "Désolé, votre recherche n'a sélectionné aucuns ingrédients."; }

			else echo $entete.$html;
		}
		else {
			echo "Erreur lors de la recherche.";
		}
	}
	else {
?>
<form class="formRecherche" name="rechercheIngredient" method="post" action="index.php?page=rechercheIngredient.php" style="width:100%;">
		<div class="barreRecherche">
			<input type="text" name="nomIngredient" style="width:50%; height:30px; font-size: 25px; text-align: center;" /><input type="submit" name="bValiderRechercheIngredient" value="Rechercher" />
		</div>
		<div style="display: block; margin-top: 50px; text-align: center;">
			<strong>Tri par :</strong>
			<div>
				<label for="idTriNom">Nom :</label><input type="radio" name="choixTri" checked="checked" value="nom" />
				<label for="idTriCategorie">Categorie :</label><input type="radio" name="choixTri" value="categorie" />
			</div>
		</div>
</form>

<?php
}
?>