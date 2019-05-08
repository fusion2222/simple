<?php

// The poorest reccomended security I ever saw. But let it be here.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function simple_partner_logos__register_simple_partner_logo_type(){
	register_post_type(SIMPLE_PARTNER_LOGOS__CONTENT_TYPE_NAME, [
		'labels' => [
			'name' => __('Partners'),
			'singular_name' => __('Partner logo'),
			'add_new_item' => __('Add new Partner logo'),
		],
		'menu_icon' => 'dashicons-awards',
		'public' => true,
		// 'has_archive' => true,
		// 'rewrite' => ['slug' => 'galeria'],  // TODO: Make proper translations
		'menu_position' => 6,
		'show_in_rest' => true,
		'supports' => ['title', 'thumbnail'],
		'hierarchical' => false,
		'taxonomies'  => ['Hlavní partneri', 'Hlavní mediálni partneri', 'Partneri', 'Mediálni partneri'],
	]);
}

function simple_partner_logos__register_taxonomies(){

	$labels = [
		'name' => 'Categories',
		'singular_name' => 'Category',
		'search_items' => 'Search categories',
		'popular_items' => 'Popular categories',
		'all_items' => 'All Categories',
		'edit_item' => 'Edit Category',
		'view_item' => 'Update Category',
		'add_new_item' => 'Add new category',
		'new_item_name' => 'New Category Name',
		'separate_items_with_commas' => 'Separate categories with commas',
		'add_or_remove_items' => 'Add or remove categories',
		'choose_from_most_used' => 'Choose from the most used categories',
		'not_found' => 'No categories found',
		'no_terms' => 'No categories',
		'items_list_navigation' => 'Logo categories pagination',
		'back_to_items' => 'Back to categories',
	];

	$category_args = [
		'description' => 'Partner logos categories',
		'public' => true,
		'hierarchical' => false,
		// 'show_ui' => false,
		'labels' => $labels,
		'show_admin_column' => true,
		'meta_box_cb' => function($post, $args){

			$taxonomy_name = $args['args']['taxonomy'];
			$terms = get_terms(['taxonomy' => $taxonomy_name, 'hide_empty' => false]);

			$attached_terms_to_post = get_the_terms($post, $taxonomy_name);
			foreach ($terms as $key => $term){
				$is_selected = has_term($term, $taxonomy_name, $post) ? ' checked' : '';
				$term_value = $term->name;
				$term_field_id = $taxonomy_name . '_' . $key;
				echo '<input type="radio" name="tax_input[' . $taxonomy_name . ']" value="' . $term_value . '" id="' . $term_field_id . '"' . $is_selected . '><label for="' . $term_field_id . '">' . $term->name . '</label><br>';
			}
		}
		
	];

	register_taxonomy(SIMPLE_PARTNER_LOGOS__TAXONOMY, SIMPLE_PARTNER_LOGOS__CONTENT_TYPE_NAME, $category_args);
	register_taxonomy_for_object_type(SIMPLE_PARTNER_LOGOS__TAXONOMY, SIMPLE_PARTNER_LOGOS__CONTENT_TYPE_NAME);
}

add_action('init', 'simple_partner_logos__register_simple_partner_logo_type');
add_action('init', 'simple_partner_logos__register_taxonomies');
