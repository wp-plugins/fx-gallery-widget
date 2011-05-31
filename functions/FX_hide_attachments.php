<?php
/*
Function: For taking out attachments out of gallery what are already displayed on page/post. Returns ID's of attachments.
Author: Aivaras Sondeckis
Author URI: http://www.3Dgrafika.lt
*/

include('FX_get_imagename_from_link.php');


// function for taking out attachments, that are on page content
if ( !function_exists('FX_hide_attachments') ) {
  function FX_hide_attachments($attachments) {
    
    // check if user is viewing single post not loop
    if ( is_single() || is_page() ) {
			
      //if (!is_array($list)) return $list;
      
      // Get the post ID
      $post_id = get_the_ID();
      
			// New array for attachments
			$hide_attachments = array();
			
			
      // Set the post content to a variable
      $fxPostContent = get_the_content();
      
      // Run preg_match_all to grab all the images and save the results in $fxPics
      $fxSearchPattern = '~src="[^"]*"~';
      preg_match_all( $fxSearchPattern, $fxPostContent, $fxPics );
  
      // Get only image name, no link
      $fxPics[0] = FX_get_imagename_from_link($fxPics[0]);
  
      // Count the results
      $iNumberOfPics = count($fxPics[0]);

      // Check to see if we have at least 1 image
      if ( $iNumberOfPics > 0 ) {
				
				// Each attachment
				foreach ( $attachments as $id => $attachment ) {
					
					// Get attachments
					$link_url = wp_get_attachment_url($id);
					
					// Get only image name, no link
					$link_url = FX_get_imagename_from_link($link_url);
					
					// Now here you would do whatever you need to do with the images
					for ( $i=0; $i < $iNumberOfPics ; $i++ ) {
						
						// If same image link is on content, add ID to array
						if($fxPics[0][$i] == $link_url) {
							$hide_attachments[] = $id;
						}
					}
				}
				
			}
    }
		return $hide_attachments;
  }
}




