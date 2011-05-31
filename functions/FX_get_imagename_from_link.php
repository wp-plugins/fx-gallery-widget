<?php
/*
Function: For getting image name, from all source link, also strip end with size like "-300x200.jpg"
Author: Aivaras Sondeckis
Author URI: http://www.3Dgrafika.lt
*/

// function for taking out attachments, that are on page
if ( !function_exists('FX_get_imagename_from_link') ) {
  function FX_get_imagename_from_link($link_array) {
    
    $numberOfLinks = count($link_array);
    
    // Check to see if we have at least 1 link
    if ( $numberOfLinks > 0 ) {
      
      $pattern = '/.+\//'; // Remove till the image name
      $link_array = preg_replace($pattern, '', $link_array);
      
      $pattern = '/(\-\d{2,4}x\d{2,4})(\....)(")$/'; // Find end ant Remove size at end '-300x400.jpg'
      $replace = '\2'; // And add back to the end ".jpg"
      $link_array = preg_replace($pattern, $replace, $link_array);
      
    }
    return $link_array;
  }
}






