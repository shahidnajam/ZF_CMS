$().ready(function() {
	$('#pageContent, #blogContent').tinymce({
		// Location of TinyMCE script
		script_url : '/_js/tiny_mce/tiny_mce.js',

		// General options
		theme : "advanced",
		skin:'o2k7',
		skin_variant:'black',
		plugins : "style,advimage,advlink,iespell,inlinepopups,preview,media,print,contextmenu,paste,noneditable,visualchars,xhtmlxtras,template,advlist,spellchecker",
		height: '500',
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,|,preview,code",
		theme_advanced_buttons2 : "bullist,numlist,blockquote,|,sub,sup,|,undo,redo,|,link,unlink,anchor,|,image,media,|,removeformat,pasteword,|,iespell,spellchecker,|,print",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		file_browser_callback : "tinyBrowser",
		// Example content CSS (should be your site CSS)
		//content_css : "/_skins/silver/_css/layout.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		
		relative_urls:false,
		remove_script_host:true,
		
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
});