<?php
	$connexion = NULL;

	// connexion à la BD
	function connectBD() {
		global $connexion;
		$connexion = mysqli_connect(SERVEUR, UTILISATEUR, MOTDEPASSE, BDD);
		if (mysqli_connect_errno()) {
		    printf("Échec de la connexion : %s\n", mysqli_connect_error());
		    exit();
		}
		mysqli_query($connexion,"SET NAMES utf8");
	}

	function deconnectBD() {
		global $connexion;
		mysqli_close($connexion);
	}

/*----------------------

	Fonction 'date'


----------------------*/

	function convertDateToSlash($strDate) { //Convertit une date au format "Y-m-d" en format "d/m/Y" 
		$date=explode("-", $strDate);
		$dateSlash=$date[2]."/".$date[1]."/".$date[0];
		return $dateSlash;
	}


/*----------------------

	Fonction 'select'


----------------------*/

	function selectIng() { //créé un <select name='nomIng'>...</select> avec les ingrédients dans la base
		global $connexion;
		$html="<select name='nomIng'>";
		$requeteIng=mysqli_query($connexion,"SELECT nomIngredient FROM INGREDIENT ORDER BY nomIngredient");
		$tabResultat=mysqli_fetch_all($requeteIng);
		foreach ($tabResultat as $ingredientI) {
			$nom=$ingredientI[0];
			$html.="<option>$nom";
		}
		$html.="</select>";
		echo $html;
	}


	function selectDate() { //créé 3 <select> pour date, mois et jour avec les options
		$html="<select name='jour'><option>1<option>2<option>3<option>4<option>5<option>6<option>7<option>8<option>9<option>10<option>11<option>12<option>13<option>14<option>15<option>16<option>17<option>18<option>19<option>20<option>21<option>22<option>23<option>24<option>25<option>26<option>27<option>28<option>29<option>30<option>31</select>";

		$html.="<select name='mois'><option>01<option>02<option>03<option>04<option>05<option>06<option>07<option>08<option>09<option>10<option>11<option>12</select>";
		$chaine = '';
		for($ind=0;$ind<91;$ind ++) { 
			$mot = (string) (2016-$ind);
			$chaine = $chaine.'<option>'.$mot;
		}
		$chaine = $chaine.'</select>';
		$html.='<select name="annee">'.$chaine.'</select>';
		echo $html;
	}


	function selectCountry() { //créé un <select name='Country' id='CountryID' >...</select> avec les pays dans la base
		global $connexion;
		$html="<select name='Country' id='CountryID'>";
		$requeteIng=mysqli_query($connexion,"SELECT pays FROM ZONE_GEOGRAPHIQUE");
		$tabResultat=mysqli_fetch_all($requeteIng);
		foreach ($tabResultat as $paysI) {
			$pays=$paysI[0];
			$html.="<option>$pays";
		}
		$html.="</select>";
		echo $html;
	}

/*----------------------

	PARTIE AJOUT RECETTE


----------------------*/

	function option($requete) { //fonction qui génère le code HTML des option d'un select, sans le select
		global $connexion;
		$resultat = mysqli_query($connexion,$requete);
		$affichageHTML="";
		while($ligne = mysqli_fetch_row($resultat)) {
			$affichageHTML.="<option>".$ligne[0];
		}
		return $affichageHTML;
	}

	function tableauCreation($varNom,$varQtite,$varUnite) {
	/* Retourne un tableau contenant un tableau par "ingredient" ou "produit"(nombre variable choisi par l'utilisateur)
	ex : avec $varNom = "ingredient" [ [$_POST['ingredient1'],$_POST['quantiteIng1'],$_POST['valeurUniteIng1']] , [$_POST['ingredient2'] ...] ... ] 
		
	*/
		$tableau=[];
		$i=1;
		do {
			$varNomI=$varNom.$i;
			$varQtiteI=$varQtite.$i;
			$varUniteI=$varUnite.$i;
			$tableauI = [$_POST[$varNomI],$_POST[$varQtiteI],$_POST[$varUniteI]];
			array_push($tableau, $tableauI);
			$i+=1;	
		} while(isset($_POST[$varNom.$i]));
		
		return $tableau;
	}

	function tableauEtapeCreation() {
	/* Meme fonction que tableauCreation, sans valeurUnite (n'y étant pas pour ETAPE)
	*/
		$tableauEtape=[];
		$varInstruction = "instruction";
		$varUstensile = "ustensile";
		$i=1;
		do {
			$varInstructionI=$varInstruction.$i;
			$varUstensilesI=$varUstensile.$i;
			$tableauEtapeI = [$_POST[$varInstructionI],$_POST[$varUstensilesI]];
			array_push($tableauEtape, $tableauEtapeI);
			$i+=1;
		}while(isset($_POST[$varInstruction.$i]));
		
		return $tableauEtape;
	}

	function requeteNecessiteIngredient($tableauIngredient,$idR) {
		global $connexion;
		$reqpIngredient="INSERT INTO NECESSITE_INGREDIENT (idR,idIng,qteNecessaireIng,valeurUnite) VALUES (?,?,?,?)";
		$prepaIngredient=mysqli_prepare($connexion,$reqpIngredient);
		$reqpRechIdIng = "SELECT idIng FROM INGREDIENT WHERE nomIngredient = ?";
		$prepaRechIdIng=mysqli_prepare($connexion,$reqpRechIdIng);
		foreach ($tableauIngredient as $ingredient) {
			$nomIngredient=$ingredient[0];
			$quantiteIng=$ingredient[1];
			$valeurUniteIng=$ingredient[2];
			mysqli_stmt_bind_param($prepaRechIdIng,"s",$nomIngredient);
			mysqli_execute($prepaRechIdIng);
			$resultId = mysqli_stmt_get_result($prepaRechIdIng);
			$idIng=mysqli_fetch_row($resultId)[0];
			mysqli_stmt_free_result($prepaRechIdIng);
			mysqli_stmt_bind_param($prepaIngredient,'iiis',$idR,$idIng,$quantiteIng,$valeurUniteIng);
			if(mysqli_execute($prepaIngredient)) {
				mysqli_stmt_free_result($prepaIngredient);
			}

			else{
				echo "Erreur lors de l'ajout des ingrédients. ";
			}
		}

		mysqli_stmt_close($prepaIngredient);
		mysqli_stmt_close($prepaRechIdIng);
	}

	function requeteNecessiteProduit($tableauProduit,$idR) {
		global $connexion;
		$reqpProduit="INSERT INTO NECESSITE_PRODUIT (idR,idProduit,qteNecessaireProd,valeurUnite) VALUES (?,?,?,?)";
		$prepaProduit=mysqli_prepare($connexion,$reqpProduit);
		$reqpRechIdProd = "SELECT idProduit FROM PRODUIT WHERE nomProduit = ?";
		$prepaRechIdProd=mysqli_prepare($connexion,$reqpRechIdProd);
		$i=-1;
		foreach ($tableauProduit as $produit) {
			$i+=1;
			$nomProduit=$produit[0];
			$quantiteProd=$produit[1];
			$valeurUniteProd=$produit[2];
			mysqli_stmt_bind_param($prepaRechIdProd,"s",$nomProduit);
			mysqli_execute($prepaRechIdProd);
			$resultId = mysqli_stmt_get_result($prepaRechIdProd);
			$idProd=mysqli_fetch_row($resultId)[0];
			mysqli_stmt_free_result($prepaRechIdProd);		
			mysqli_stmt_bind_param($prepaProduit,'iiis',$idR,$idProd,$quantiteProd,$valeurUniteProd);
			if(mysqli_execute($prepaProduit)) {
				mysqli_stmt_free_result($prepaProduit);
			}
			
			else {
				echo "Erreur lors de l'ajout des produits.";
			}
		}
		mysqli_stmt_close($prepaProduit);
		mysqli_stmt_close($prepaRechIdProd);
	}

?>