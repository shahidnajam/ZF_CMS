$(document).ready(function(){
	//search box auto clear
	$('#query').focus(function(){
		if($('#query').val() == "Search...") { 
			$('#query').val(''); 
			$('#query').css('color', '#666666');
		}
	});
	$('#query').blur(function(){
		if($('#query').val() == "") { 
			$('#query').val('Search...'); 			
			$('#query').css('color', '#aaaaaa');
		}
	});
});