<?php // add the admin options page
add_action('admin_menu', 'krs_plugin_admin_add_page');

function krs_plugin_admin_add_page() {
  add_options_page('KRS Settings', 'KRS Settings', 'manage_options', 'krs-settings', 'krs_plugin_options_page');
}

function krs_plugin_options_page() {
?>
<div>
<h2>KRS plugin Settings</h2>
Settings für den KRS Plugin
<form action="options.php" method="post">
<?php settings_fields('krs_plugin_options'); ?>
<?php do_settings_sections('krs-settings'); ?>

<input id="krs_save" disabled class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<?php
}

add_action('admin_init', 'krs_plugin_admin_init');
function krs_plugin_admin_init(){
register_setting( 'krs_plugin_options', 'options'); //, 'krs_plugin_options_validate' );
add_settings_section('krs_logo', 'Shortcode [logo]', 'krs_logo_section_text', 'krs-settings');
add_settings_field('image_attachment_id', 'Logo Bild', 'plugin_setting_string', 'krs-settings', 'krs_logo');
}
/*
function krs_plugin_options_validate() {
  $newinput['url'] = trim($input['url']);
  if(!preg_match('/^[a-z0-9]{32}$/i', $newinput['url'])) {
    $newinput['url'] = '';
  }
  return $newinput;
}
*/

function krs_logo_section_text() {
  //Not required
}

function plugin_setting_string() {
  //defined in kunstraump.php:krs_options
  $logo = krs_options();
  wp_enqueue_media();
  //add_action( 'admin_enqueue_scripts', 'function_name' );

?>
<div class='image-preview-wrapper'>
		<img id='image-preview' src='<?php echo $logo['url']; ?>'  height='100' style='max-height: 100px;'>
	</div>
  <input type='hidden' name='options[logo_id]' id='image_attachment_id' value='<?php echo $logo['id']; ?>'>
	<input id="select_logo_button" style='width:180px;' type="button" class="button" value="<?php _e( 'Select Logo' ); ?>" />
  <input id="use_default_logo_button" type="button" class="button" value="<?php _e( 'Use Default Logo' ); ?>" />
  <?php
}

add_action( 'admin_footer', 'media_selector_print_scripts' );
//add_action( 'admin_enqueue_scripts', 'media_selector_print_scripts' );
function media_selector_print_scripts($hook) {
  //echo serialize($hook);
  $logo = krs_options();

	?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame,
        previous_logo_id = <?php echo $logo['id']; ?>,
        selected_logo_id = previous_logo_id; // Set this

      function newSelection(id, url) {
        if (selected_logo_id === id) return;
        $( '#image-preview' ).attr( 'src', url ).css( 'width', 'auto' );
        $( '#image_attachment_id' ).val( id );
        selected_logo_id = id;
        $('#krs_save').prop('disabled', previous_logo_id === selected_logo_id);
      }

      $('#use_default_logo_button').on('click', function(){
        newSelection(-1, '<?php echo  KRS_LOGO; ?>');
      });

			$('#select_logo_button').on('click', function(){
				// If the media frame already exists, reopen it.
				if ( !file_frame ) {
  				// Create the media frame.
  				file_frame = wp.media.frames.file_frame = wp.media({
  					title: 'Select logo',
  					button: {
  						text: 'Use this image',
  					},
  					multiple: false	// Set to true to allow multiple files to be selected
  				});

  				// When an image is selected, run a callback.
  				file_frame.on( 'select', function() {
  					// We set multiple to false so only get one image from the uploader
  					var attachment = file_frame.state().get('selection').first();
            newSelection(attachment.get('id'), attachment.get('url'));
  				});
        }
				// Finally, open the modal
				file_frame.open();
			});
		});

	</script><?php

}
