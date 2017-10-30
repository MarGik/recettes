$(function(){
	$('.bStatDeroulant').click(function(){
		$('.statDeroulant').slideToggle("slow");
		return false;
	});
});

$(function(){
	$(".bLienDeroulant").click(function(){
		$(this).find(".lienDeroulant").slideToggle("slow");
	});
});

