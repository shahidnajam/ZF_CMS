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
    $('#commentForm #recaptcha_response_field').css({
        border:'1px solid #dfdfdf',
        fontSize:'1.5em',
        padding:'5px',
        width: '290px'
    });
    $('#contactForm #recaptcha_response_field').css({
        border:'1px solid #dfdfdf',
        fontSize:'1.5em',
        padding:'5px',
        width: '337px'
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
        target:			'#commentGroup',
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
jQuery(document).ready(function($){
    //syntax highlight
    if(jQuery.beautyOfCode != undefined){
	    jQuery.beautyOfCode.init({
	        theme: 'Default'
	    });
    }


    $('div.blogContent p span').each(function(i,el){
    	console.log($(this));
    	var brushClass = $(this).attr('class');
    	console.log(brushClass);
    	
    	var $codeElement = $(this).find('code');
    	$codeElement.addClass(brushClass)
    	console.log($codeElement);
    	console.log('fos');
    	var $newMarkup = $('<pre></pre>')
    						.addClass('code')
    						.prepend($codeElement);
    	console.log($newMarkup);
    	$newMarkup.insertAfter($(this));
    });
});

