$('document').ready(function(){
	$('#hideTags').appendTo('#tags-element');
	$('div#hideTags ul.Zend_Tag_Cloud li a').click(function(){
		var tagFieldContents = $('#tags').val();

		if(tagFieldContents == '' && tagFieldContents.indexOf($(this).text()) < 0) {
			tagFieldContents += $(this).text();
		}
		else if(tagFieldContents.indexOf($(this).text()) < 0) {
			tagFieldContents += ',' + $(this).text();
		}
		$('#tags').val(tagFieldContents);
		return false;
	});
});