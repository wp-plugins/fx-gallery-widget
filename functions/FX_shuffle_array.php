<?php
/*
Function: For random shuffling array
Author: Aivaras Sondeckis
Author URI: http://www.3Dgrafika.lt
*/

// function for proper associative array shuffling
if ( !function_exists('FX_shuffle_array') ) {
  function FX_shuffle_array($list) {
    if (!is_array($list)) return $list;
  
    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key)
      $random[$key] = $list[$key];
  
    return $random;
  }
}

?>