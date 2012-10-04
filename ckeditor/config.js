/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = 'kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = 'kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = 'kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = 'kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = 'kcfinder/upload.php?type=flash';
    
    config.toolbar_Full.push({name: 'vt', items : [ 'vt_closeinbody', 'vt_dontshowagain', 'vt_minimizeinbody', 'vt_insertparams', 'vt_insert_templates']});
	
	
};