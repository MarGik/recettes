<?php
$requeteNbrUtilisateurs = mysqli_query($connexion,"SELECT COUNT(nom) AS nbrU FROM UTILISATEUR");
$nbrUtilisateur = mysqli_fetch_row($requeteNbrUtilisateurs)[0];

$requeteNbrRecette = mysqli_query($connexion,"SELECT COUNT(idR) AS nbrRecette FROM RECETTE");
$nbrRecette = mysqli_fetch_row($requeteNbrRecette)[0];

$requeteNbrIngredient = mysqli_query($connexion,"SELECT COUNT(idIng) AS nbrIngredient FROM INGREDIENT");
$nbrIngredient = mysqli_fetch_row($requeteNbrIngredient)[0];


?>

<ul class="statDeroulant">
	<li>Nombre d'utilisateurs : <?php echo $nbrUtilisateur;?></li>
	<li>Nombre de recettes : <?php echo $nbrRecette;?></li>
	<li>Nombre d'ingrédients : <?php echo $nbrIngredient;?></li>
</ul>