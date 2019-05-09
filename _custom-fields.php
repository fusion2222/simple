<?php 

function simple_partner_logos__create_type_metabox() {
	// Can only be used on a single post type (ie. page or post or a custom post type).
	// Must be repeated for each post type you want the metabox to appear on.
	add_meta_box(
		SIMPLE_PARTNER_LOGOS__LINK_METABOX_ID, // Metabox ID
		'Link', // Title to display
		'simple_partner_logos__render_type_metabox', // Function to call that contains the metabox content
		SIMPLE_PARTNER_LOGOS__CONTENT_TYPE_NAME, // Post type to display metabox on
		'side', // Where to put it (normal = main colum, side = sidebar, etc.)
		'high' // Priority relative to other metaboxes
	);

}

add_action('add_meta_boxes', 'simple_partner_logos__create_type_metabox' );


/**
 * Render the metabox markup
 * This is the function called in `_namespace_create_metabox()`
 */
function simple_partner_logos__render_type_metabox() {
	// Variables
	global $post; // Get the current post data

	// Get the saved values
	$details = get_post_meta($post->ID, SIMPLE_PARTNER_LOGOS__LINK_FIELD_ID, true) ?? '';  

	// The `esc_attr()` function here escapes the data for
	// HTML attribute use to avoid unexpected issues.
?>

	<label for="<?php print SIMPLE_PARTNER_LOGOS__LINK_FIELD_ID; ?>"><b>Link</b></label>
	<br>
	<input
		class="regular-text"
		style="width: 100%;"
		type="text"
		id="<?php print SIMPLE_PARTNER_LOGOS__LINK_FIELD_ID; ?>"
		name="<?php print SIMPLE_PARTNER_LOGOS__LINK_FIELD_ID; ?>"
		placeholder="<?php echo get_site_url(); ?>"
		value="<?php echo htmlentities($details); ?>"
	>
	<br>

<?php
	/*
		Security field - This validates that submission came from the
		actual dashboard and not the front end or a remote server.
	*/
	wp_nonce_field( SIMPLE_PARTNER_LOGOS__TYPE_NONCE_FIELD_ID, SIMPLE_PARTNER_LOGOS__TYPE_NONCE_PROCESS);
}


/**
 * Save the metabox
 * @param  Number $post_id The post ID
 * @param  Array  $post    The post data
 */
function simple_partner_logos__save_type_metabox($post_id, $post) {

	// Verify that our security field exists. If not, bail.
	if ( !isset($_POST[SIMPLE_PARTNER_LOGOS__TYPE_NONCE_PROCESS] ) ){
		return;
	}

	// Verify data came from edit/dashboard screen
	if ( !wp_verify_nonce($_POST[SIMPLE_PARTNER_LOGOS__TYPE_NONCE_PROCESS], SIMPLE_PARTNER_LOGOS__TYPE_NONCE_FIELD_ID) ) {
		return $post->ID;
	}

	// Verify user has permission to edit post
	if ( !current_user_can('edit_post', $post->ID )) {
		return $post->ID;
	}

	/*
	 * Sanitize the submitted data
	 * This keeps malicious code out of our database.
	 * `wp_filter_post_kses` strips our dangerous server values
	 * and allows through anything you can include a post.
	 */
	$sanitized = wp_filter_post_kses( $_POST[SIMPLE_PARTNER_LOGOS__LINK_FIELD_ID] ?? '');

	// Save our submissions to the database
	update_post_meta($post->ID, SIMPLE_PARTNER_LOGOS__LINK_FIELD_ID, $sanitized);
}

add_action('save_post', 'simple_partner_logos__save_type_metabox', 1, 2);
