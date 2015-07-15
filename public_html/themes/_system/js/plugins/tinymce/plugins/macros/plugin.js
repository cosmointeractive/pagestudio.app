/*
 * Custom ShortCode Plugin
 * 
 * Provides method to add custom macros (or shortcodes) to the editor. 
 * 
 * @author     Cosmo Mathieu <cosmo@cimwebdesigns.com>
 * @version    Version 0.1
 * @source     http://www.tinymce.com/tryit/listbox.php
 */
tinymce.PluginManager.add('macros', function(editor, url) {
 
    /*
     * Split Button
     * Adds a menu item to the tools menu
     */
	editor.addButton('macros', {
        type: 'splitbutton',
        text: 'Macros',
        icon: false,
        onclick: function() {
            //editor.insertContent('[macro_name option=""] [/macro_name]');
        },
        menu: [
            {text: 'Page Excerpt', onclick: function() {editor.insertContent('[page_excerpt size="small"] [/page_excerpt]');}},
            {text: 'Featured', onclick: function() {editor.insertContent('[featured_heading] [/featured_heading]');}},
            {text: 'Post Cover', onclick: function() {editor.insertContent('[media] [/media]');}},
            {text: 'Member Picture', onclick: function() {editor.insertContent('[member_picture] [/member_picture]');}},
            {text: 'Button', onclick: function() {editor.insertContent('[button text="Save me" size"medium" link="#"]');}},
            {text: 'Counter', onclick: function() {editor.insertContent('[live_sermon_counter size="small"]');}},
            {text: '3 Columns First', onclick: function() {editor.insertContent('[cols_3 first="yes"] [/cols_3]');}},
            {text: '3 Columns', onclick: function() {editor.insertContent('[cols_3] [/cols_3]');}},
            {text: '3 Columns Last', onclick: function() {editor.insertContent('[cols_3 last="yes"] [/cols_3]');}},
            {text: 'Map', onclick: function() {editor.insertContent('[map-it title="Our Location" address="157 Montague Road Greenville, SC" height="300" width="300"]');}},
            {text: 'Picture', onclick: function() {editor.insertContent('[picture width="500" height="300"]');}}
        ]
	}); 
    
    /*
    editor.addButton('macros', {
        type: 'listbox',
        text: 'My listbox',
        icon: false,
        onselect: function(e) {
            editor.insertContent(this.value());
        },
        values: [
            {text: 'Menu item 1', value: 'Some text 1'},
            {text: 'Menu item 2', value: 'Some text 2'},
            {text: 'Menu item 3', value: 'Some text 3'}
        ],
        onPostRender: function() {
            // Select the second item by default
            this.value('Some text 2');
        }
	}); 
    */     
});