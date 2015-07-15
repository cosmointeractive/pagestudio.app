	/* -------------------------------------------------------- 
		mode : "textareas",
		theme : "advanced",
		editor_selector : "mceSimple",
	 */
	tinyMCE.init({
		selector: "textarea.mceAdvanced",
		theme: "modern",
		skin: "cimp",
		//width: 680,
		//height: 300,
        // forced_root_block : "",
		link_list: [
			{title: 'My page 1', value: 'http://www.tinymce.com'},
			{title: 'My page 2', value: 'http://www.tecrail.com'}
		],
		plugins: [
			"autoresize advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker", 
			"table contextmenu directionality emoticons paste textcolor responsivefilemanager codemirror fullscreen macros"
		],
		relative_urls: false,
		browser_spellcheck : true ,
		filemanager_title:"Responsive Filemanager",
		external_filemanager_path:base_url + "application/plugins/file_manager/",
		external_plugins: { "filemanager" : base_url + "application/plugins/file_manager/plugin.min.js"},
		codemirror: {
			indentOnInit: true, // Whether or not to indent code on init. 
			path: 'CodeMirror'
		},

		image_advtab: true,
		statusbar: false,
		menubar: false,
		toolbar1: "undo redo | bold italic link | alignleft aligncenter alignright styleselect | numlist bullist outdent indent | cut pastetext charmap removeformat responsivefilemanager image | macros code fullscreen",
		content_css : base_url + "public_html/themes/_system/js/plugins/tinymce/skins/cimp/editor.css"    // resolved to http://domain.mine/mycontent.css
	});	
	
	
	/* -------------------------------------------------------- 
	 * MCE Simple	
	 */
	tinyMCE.init({
		selector: "textarea.mceSimple",
		theme: "modern",
		skin: "cimp",
		menu : {    
			test: {title: 'Test Menu', items: 'newdocument'} 
		},
		//menubar: 'test',
		menubar:false,
		statusbar: false,
		
		link_list: [
			{title: 'Contact Page', value: 'http://www.tinymce.com'},
			{title: 'About Page', value: 'http://www.tecrail.com'}
		],
		plugins: [
			"autoresize advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
			"table contextmenu directionality emoticons paste textcolor responsivefilemanager codemirror fullscreen"
		],
		relative_urls: false,
		browser_spellcheck : true ,
		// filemanager_title:"Responsive Filemanager",
		// external_filemanager_path:base_url + "application/plugins/file_manager/",
		// external_plugins: { "filemanager" : base_url + "application/plugins/file_manager/plugin.min.js"},
		codemirror: {
			indentOnInit: true, // Whether or not to indent code on init. 
			path: 'CodeMirror'
		},

		//image_advtab: true,
		toolbar1: "undo redo | bold italic underline strikethrough | bullist numlist | code",
		content_css : base_url + "public_html/themes/_system/js/plugins/tinymce/skins/cimp/editor.css"    // resolved to http://domain.mine/mycontent.css
	});	
	