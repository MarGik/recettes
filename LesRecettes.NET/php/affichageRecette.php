<?php 
	if(isset($_GET["idR"])) {
		$idR = $_GET["idR"];
		$html="";
		$requeteRecette=mysqli_query($connexion,"SELECT titre,categorie,nbPersonne,description FROM RECETTE WHERE idR=$idR");
		$recette=mysqli_fetch_assoc($requeteRecette);
		$titre=stripslashes($recette['titre']); 
		$description=stripslashes($recette['description']);
		$html.="<h1>".$titre."</h1><em style='margin-bottom:50px;'>".$recette['categorie']." pour ".$recette['nbPersonne']." personnes</em>
				<h3 style='align-self:flex-start;'>Description :</h3>
				<p style='align-self:flex-start;'>".$description."</p>
				<div id='listesIngProd' style='align-self:flex-start;'>
					<div id='listeIng'>
						<h3 style='align-self:flex-start;'>Ingredients :</h3>
				";
		$requeteIngredients=mysqli_query($connexion,"SELECT nomIngredient,qteNecessaireIng,valeurUnite FROM NECESSITE_INGREDIENT n LEFT JOIN INGREDIENT i ON n .idIng = i .idIng WHERE n .idR =".$idR);
		$tabIngredients=mysqli_fetch_all($requeteIngredients);
		mysqli_free_result($requeteIngredients);
		$html.="<ul>";
		foreach ($tabIngredients as $ing) {
			$html.="<li>".$ing[0]." : ".$ing[1]." ".$ing[2]."</li>";
		}
		$html.="</ul></div>";
		$requeteProduits=mysqli_query($connexion,"SELECT nomProduit,qteNecessaireProd,valeurUnite FROM NECESSITE_PRODUIT n LEFT JOIN PRODUIT p ON n .idProduit = p .idProduit WHERE n .idR =".$idR);
		$tabProduits=mysqli_fetch_all($requeteProduits);
		mysqli_free_result($requeteProduits);
		$html.="<div id='listeProd'><h3 style='align-self:flex-start;'>Produits :</h3><ul>";
		foreach ($tabProduits as $prod) {
			$html.="<li>".$prod[0]." : ".$prod[1]." ".$prod[2]."</li>";
		}
		$html.="</ul></div></div>";
		$html.="<h3 style='align-self:flex-start;'>Instructions :</h3>";		
		$requeteEtape=mysqli_query($connexion,"SELECT numero,instructions FROM ETAPE WHERE idR=$idR");
		$tabEtape=mysqli_fetch_all($requeteEtape,MYSQLI_ASSOC);
		$prepaNecessiteUstensile=mysqli_prepare($connexion,"SELECT nom FROM USTENSILE WHERE idR=$idR AND numero=?");
		foreach ($tabEtape as $etape) {
			$instructions=stripslashes($etape['instructions']);
			$html.="<div style='align-self:flex-start;'>".$etape['numero'].". ".$instructions."</div>";
		}
		echo $html;
	}

	else {
		echo "Erreur";
	}
?>