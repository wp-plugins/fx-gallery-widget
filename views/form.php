<?php
$order_options = array('Random' => 'rand', 'Ascending' => 'asc', 'Descending' => 'desc');
$link_type_options = array('File' => 'file', 'Anchor on Post/Page' => 'anchor', 'Post/Page' => 'post', 'Attachment' => 'attachment', 'None' => 'none');
$image_size_options = get_intermediate_image_sizes();

$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'post_id' => '', 'num_images' => '0', 'image_size' => 'thumbnail', 'order' => 'rand', 'link_type' => 'file', 'before_title' => '', 'link_rel' => '' ) );
$title = strip_tags($instance['title']);
$show_from_current_page = $instance['show_from_current_page'] ? 'checked="checked"' : '';
$post_id = $instance['post_id'];
$num_images = $instance['num_images'];
$show_captions = $instance['show_captions'] ? 'checked="checked"' : '';
$image_size = $instance['image_size'];
$order = $instance['order'];
$link_type = $instance['link_type'];
$before_link_title = strip_tags($instance['before_link_title']);
$link_rel = strip_tags($instance['link_rel']);
?>
<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
<em>Leave blank for no title</em>
</p>

<p><input class="checkbox" type="checkbox" <?php echo $show_from_current_page; ?> id="<?php echo $this->get_field_id('show_from_current_page'); ?>" name="<?php echo $this->get_field_name('show_from_current_page'); ?>" />
  <label for="<?php echo $this->get_field_id('show_from_current_page'); ?>"><?php _e('Show from current page/post'); ?></label></p>

<p><label for="<?php echo $this->get_field_id('post_id'); ?>"><?php _e('Page or post ID:'); ?></label>
<input id="<?php echo $this->get_field_id('post_id'); ?>" name="<?php echo $this->get_field_name('post_id'); ?>" type="text" size="3" value="<?php echo $post_id; ?>" /><br />
  <em>(Show this if not selected to show from current page/post)</em></p>

<p><label for="<?php echo $this->get_field_id('num_images'); ?>"><?php _e('Number of images to show:'); ?></label>
<input id="<?php echo $this->get_field_id('num_images'); ?>" name="<?php echo $this->get_field_name('num_images'); ?>" type="text" size="1" value="<?php echo $num_images; ?>" /><br />
<em>(Enter 0 for all photos)</em></p>

<p><input class="checkbox" type="checkbox" <?php echo $show_captions; ?> id="<?php echo $this->get_field_id('show_captions'); ?>" name="<?php echo $this->get_field_name('show_captions'); ?>" />
<label for="<?php echo $this->get_field_id('show_captions'); ?>"><?php _e('Show captions'); ?></label></p>

<p><label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image size'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
<?php
foreach ( $image_size_options as $image_size_option ) {
  echo '<option value="' . $image_size_option . '"'
      . ( $image_size_option == $instance['image_size'] ? ' selected="selected"' : '' )
      . '>' . $image_size_option . "</option>\n";
}
?>
</select>
<small><em><?php _e('Choose any'); ?> <a href="http://codex.wordpress.org/Function_Reference/add_image_size" target="_blank"><?php _e('registered size in WordPress.'); ?></a></em></small></p>

<p><label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order of photos'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
<?php
foreach ( $order_options as $order_name => $order_value ) {
echo '<option value="' . $order_value . '"'
     . ( $order_value == $instance['order'] ? ' selected="selected"' : '' )
     . '>' . $order_name . "</option>\n";
}
?>
</select></p>

<p><label for="<?php echo $this->get_field_id('link_type'); ?>"><?php _e('Type of link'); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id('link_type'); ?>" name="<?php echo $this->get_field_name('link_type'); ?>">
<?php
foreach ( $link_type_options as $link_type_name => $link_type_value ) {
  echo '<option value="' . $link_type_value . '"'
     . ( $link_type_value == $instance['link_type'] ? ' selected="selected"' : '' )
     . '>' . $link_type_name . "</option>\n";
}
?>
</select></p>

<p><label for="<?php echo $this->get_field_id('before_link_title'); ?>"><?php _e('Text before link title:'); ?></label>
<input id="<?php echo $this->get_field_id('before_link_title'); ?>" class="widefat" name="<?php echo $this->get_field_name('before_link_title'); ?>" type="text" value="<?php echo $before_link_title; ?>" />
<em>(appears as tooltip)</em></p>

<p><label for="<?php echo $this->get_field_id('link_rel'); ?>"><?php _e('Link rel attribute:'); ?></label>
<input id="<?php echo $this->get_field_id('link_rel'); ?>" class="widefat" name="<?php echo $this->get_field_name('link_rel'); ?>" type="text" size="3" value="<?php echo $link_rel; ?>" />
<em>(e.g. lightbox[gallery-widget])</em></p>