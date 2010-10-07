jQuery(document).ready(function($){
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
	//fix ugly recaptcha border
	$('#recaptcha_response_field').css({
			border:'1px solid #dfdfdf', 
			fontSize:'1.5em', 
			padding:'5px', 
			width: '290px'
		}); 
	//fix ugly recaptcha buttons
	$('#recaptcha_reload').attr('src', '/_skins/silver/_img/re_refresh.png');
	$('#recaptcha_switch_audio').attr('src', '/_skins/silver/_img/re_audio.png');
	$('#recaptcha_whatsthis').attr('src', '/_skins/silver/_img/re_help.png');
});

jQuery(document).ready(function($){
	//jQuery UI Buttons
	$("#submit, button, input:submit, .button").button();

	//ajax comment form posting
	var ajaxFormOptions = {
			type: 			'POST',
			target:			'#comments',
			beforeSubmit:	validateRequired,
			success:		successHandler
	};
	function validateRequired(formData, jqForm, options){
		return true;
	}
	function successHandler(responseText, statusText, xhr, $form){
	}
	$('body').delegate('.ajax-form', 'submit', function(){
		$(this).ajaxSubmit(ajaxFormOptions);
		return false;
	});
});