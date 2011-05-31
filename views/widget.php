<?php

echo $before_widget;
    
if ( !empty( $title ) ) {
  echo $before_title . $title . $after_title; 
}
  
//If checked show_from_current_page then shows gallery from page or post that is beeing displayed
if ( $show_from_current_page ) { 
  if ( is_single() || is_page() )
    $post_id = get_the_ID();
}

// if post id is set
if ($post_id) {

  $attachments = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order) );
  
	$hide_attachments = array();
	
  //take out attachments from array what are showed on page or post
  if ( $hide_if_on_page ) 
    $hide_attachments = FX_hide_attachments($attachments);		
	
  if ( !empty($attachments) ) {
  
    if ($order == 'rand')
      $attachments = FX_shuffle_array($attachments);
  
    $output = "<div class='fxgallery'>";
    
    $i = 0;
    
    foreach ( $attachments as $id => $attachment ) {
    
      if ($num_images != 0 && $i >= $num_images)
        break;
			
			if (!in_array($id, $hide_attachments)) {
	
				$thumb = wp_get_attachment_image_src($id, $image_size);
					
				if ($before_link_title != '')
					$link_title = "$before_link_title $attachment->post_title";
				else
					$link_title = $attachment->post_title;
				
				$image_output = '<img src="' . $thumb[0] . '" alt="' . $link_title . '" title="' . $link_title . '" width="'.$thumb[1].'" height="'.$thumb[2].'" class="fxgallery_image" />';
				$link_output = '';
				
				if ($link_type != 'none') {
				
					if ($link_type == 'file')
						$link_url = wp_get_attachment_url($id);
					elseif ($link_type == 'post')
						$link_url = get_permalink($post_id);
					elseif ($link_type == 'anchor')
						$link_url = get_permalink($post_id)."#attachment_$id";
					elseif ($link_type == 'attachment')
						$link_url = get_attachment_link($id);
	
					$link_output .= "<a href='$link_url'";
					
					if ($link_rel != '')
						$link_output .= "rel='$link_rel'";
					
					$link_output .= "title='$link_title'>$image_output</a>";
				}
				else
					$link_output = $image_output;
				
				$output .= $link_output;
				
				if ($show_captions == '1') {
					$caption = $attachment->post_excerpt;
					$output .= "<span class='fxgallery_caption'>$caption</span>";
				}
			}
      
      $i++;
    } 

    $output .= "
    </div>\n";

    echo $output;
  } // !empty($attachments)

}    

echo $after_widget;
?>