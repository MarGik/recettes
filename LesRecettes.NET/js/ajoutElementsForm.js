
//Ajout d'étapes

$(function(){
    $('#idLienEtape').click(function() {
        var i=$("tr:last > td > input").attr('info');
        var i2=Number(i)+1;
        i2=String(i2);
        var htmlEtape="<tr><td class='tdAttributEtape'><label><strong>"+i2+".</strong>1 Instructions:</label></br><label><strong>"+i2+".</strong>2 Ustensiles:</label></td><td><textarea cols='60' rows='2' name='instruction"+i2+"' info="+i2+" ></textarea></br><input class='inputUstensile' type='text' name='ustensile"+i2+"' info="+i2+" /></td></tr>";
        $("#tableauRecette").append(htmlEtape);
    });
});

//Ajout d'ingrédients

$(function(){
    $('#idLienIngredient').click(function() {
        var i=$(".classIng:last").attr('info');
        var i2=Number(i)+1;
        i2=String(i2);
        var optionIngredient = $("#optionIngredient").val();
        var optionUnite = $("#optionUnite").val();
        var htmlIngredient="<tr info="+i2+" class='classIng'><td><label><strong>"+i2+". </strong></label><select name='ingredient"+i2+"'>"+optionIngredient+"</select><label><strong> Quantité: </strong></label><input type='number' min='0' name='quantiteIng"+i2+"' /> <select name='valeurUniteIng"+i2+"'>"+optionUnite+"</select></td></tr>";
        $(".classIng:last").after(htmlIngredient);
    });
});



//Ajout de produits

$(function(){
    $('#idLienProduit').click(function() {
        var i=$(".classProduit:last").attr('info');
        var i2=Number(i)+1;
        i2=String(i2);
        var optionProduit = $("#optionProduit").val();
        var optionUnite = $("#optionUnite").val();
        var htmlIngredient="<tr info="+i2+" class='classProduit'><td><label><strong>"+i2+". </strong></label><select name='produit"+i2+"'>"+optionProduit+"</select><label><strong> Quantité: </strong></label><input type='number' min='0' name='quantiteProduit"+i2+"'/> <select name='valeurUniteProduit"+i2+"'>"+optionUnite+"</select></td></tr>";
        $(".classProduit:last").after(htmlIngredient);
    });
});
