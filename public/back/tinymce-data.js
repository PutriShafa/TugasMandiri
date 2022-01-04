/*Tinymce Init*/

$(function() {
	"use strict";
	
	tinymce.init({
	  selector: '.tinymce',
	  height: 200,
	  plugins: [
		'advlist autolink lists link image charmap print preview anchor',
		'searchreplace visualblocks code fullscreen',
		'insertdatetime media table contextmenu paste code'
	  ],
	  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
	  paste_data_images: true,
	 
	});
});
