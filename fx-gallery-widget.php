<?php
/*
Plugin Name: FX Gallery Widget
Plugin URI: http://www.wordpress.org
Description: Widget to display a  gallery of images attached to a current page or post (or to specific page or post by ID). In options user may set number of images, any registered image size, type of link, post ID and order.
Version: 1.0.1
Author: Aivaras Sondeckis
Author URI: http://www.3Dgrafika.lt
*/

if ( !class_exists('FXGalleryWidget') ) {
  class FXGalleryWidget extends WP_Widget {
  
    function FXGalleryWidget() {
      $widget_ops = array('classname' => 'fxgallery_widget', 'description' => __('Displays gallery in widget area from current page or post, or from other page or post, set by ID.'));
      $this->WP_Widget('FXGalleryWidget', __('FX Gallery Widget'), $widget_ops);
    }
    
    function widget( $args, $instance ) {
      extract($args);
      $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance);
      $show_from_current_page = $instance['show_from_current_page'] ? '1' : '0';
      $post_id = $instance['post_id'];
      $num_images = $instance['num_images'];
      $show_captions = $instance['show_captions'] ? '1' : '0';
      $image_size = $instance['image_size'];
      $order = $instance['order'];
      $link_type = $instance['link_type'];
      $before_link_title = strip_tags($instance['before_link_title']);
      $link_rel = strip_tags($instance['link_rel']);
      
      include('views/widget.php');
    }
    
    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      if ( !ctype_digit($new_instance['post_id']) )
        $instance['post_id'] =  '';
      else
        $instance['post_id'] = intval($new_instance['post_id']);
      
      $instance['show_from_current_page'] = $new_instance['show_from_current_page'] ? 1 : 0;
      
      if ( !ctype_digit($new_instance['num_images']) )
        $instance['num_images'] =  '0';
      else
        $instance['num_images'] = intval($new_instance['num_images']);
      
      $instance['show_captions'] = $new_instance['show_captions'] ? 1 : 0;
      $instance['image_size'] = $new_instance['image_size'];
      $instance['order'] = $new_instance['order'];
      $instance['link_type'] = $new_instance['link_type'];
      $instance['before_link_title'] = strip_tags($new_instance['before_link_title']);
      $instance['link_rel'] = strip_tags($new_instance['link_rel']);
      return $instance;
    }
  
    function form( $instance ) {
      include('views/form.php');
    }
  }
  function FXGalleryWidget_init() {
      register_widget('FXGalleryWidget');
  }
  
  add_action('widgets_init', 'FXGalleryWidget_init');
}

// function for proper associative array shuffling
if ( !function_exists('shuffle_assoc') ) {
  function shuffle_assoc($list) {
    if (!is_array($list)) return $list;
  
    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key)
      $random[$key] = $list[$key];
  
    return $random;
  }
}