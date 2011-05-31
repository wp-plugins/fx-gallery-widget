<?php
/*
Function: For taking out attachments out of page/post
Author: Aivaras Sondeckis
Author URI: http://www.3Dgrafika.lt
*/

// function filter the content and remove attachments
if ( !function_exists('FX_remove_attachments_filter') ) {
	function FX_remove_attachments_filter($fxPostContent) {

		if (  get_option('FXGalleryWidget_remove_images_from_page') ) {
			// Define the pattern to search
			$fxSearchPattern = '~<img [^\>]*\ />~';
			$fxPostContent = preg_replace($fxSearchPattern, '', $fxPostContent);
		}
		
		return $fxPostContent;
  }
}






