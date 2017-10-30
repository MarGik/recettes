<?php
	if(isset($_POST["bValiderRechercheRecette"])) {
		if($_POST["choixTri"] == "categorie") { $tri="categorie"; }
		elseif($_POST["choixTri"] == "nbPersonne") { $tri="nbrPersonne"; }
		else { $tri="titre"; }
		$recherche=mysqli_real_escape_string($connexion,$_POST["titre"]);
		if(empty($recherche)) {
			$requete = "SELECT idR,titre,categorie,nbPersonne FROM RECETTE ORDER BY ".$tri;
		}
		else {
			$requete = "SELECT idR,titre,categorie,nbPersonne FROM RECETTE WHERE titre LIKE '".$recherche."%' ORDER BY ".$tri;
		}
		if ($requeteExec=mysqli_query($connexion,$requete)) {
			$entete="<div class='divLegend'><h1 class='titresRecette'>Titre :</h1><h1 class='titresRecette'>Categorie :</h1><h1 class='titresRecette'>Nombre de personnes :</h1></div>";
			$html="";
			while($ligne=mysqli_fetch_row($requeteExec)) {
				$html.="<a href='index.php?page=affichageRecette.php&idR=".$ligne[0]."' class='divRecette'><em class='valeursRecette'>".$ligne[1]."</em><em class='valeursRecette'>".$ligne[2]."</em><em class='valeursRecette'>".$ligne[3]."</em></a>";
			}

			if (empty($html)) { echo "Désolé, votre recherche n'a sélectionné aucunes recettes."; }

			else echo $entete.$html;
		}
		else {
			echo "Erreur lors de la recherche.";
		}
	}
	else {
?>
<form class="formRecherche" name="rechercheRecette" method="post" action="index.php?page=rechercheRecette.php" style="width:100%;">
		<div class="barreRecherche">
			<input type="text" name="titre" style="width:50%; height:30px; font-size: 25px; text-align: center;" /><input type="submit" name="bValiderRechercheRecette" value="Rechercher" />
		</div>
		<div style="display: block; margin-top: 50px; text-align: center;">
			<strong>Tri par :</strong>
			<div>
				<label for="idTriTitre">Titre :</label><input id="idTriTitre" type="radio" name="choixTri" checked="checked" value="titre" />
				<label for="idTriCategorie">Categorie :</label><input id="idTriCategorie" type="radio" name="choixTri" value="categorie" />
				<label for="idTriNbPers">Nombre de personnes :</label><input id="idTriNbPers" type="radio" name="choixTri" value="nbPersonne" />
			</div>
		</div>
</form>

<?php
}
?>