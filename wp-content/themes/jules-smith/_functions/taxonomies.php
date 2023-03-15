<?php
// Register Book categories taxonomy
function register_book_cats() {

	$labels = array(
		'name'                       => _x( 'Book Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Book Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Book Categories', 'text_domain' ),
		'all_items'                  => __( 'All Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Categories', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Category', 'text_domain' ),
		'update_item'                => __( 'Update Category', 'text_domain' ),
		'view_item'                  => __( 'View Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular categories', 'text_domain' ),
		'search_items'               => __( 'Search categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No categories', 'text_domain' ),
		'items_list'                 => __( 'Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'               => [ 'with_front' => false ],
	'show_in_graphql' => true, # Set to false if you want to exclude this type from the GraphQL Schema
	'graphql_single_name' => 'book_cat', 
	'graphql_plural_name' => 'book_cats', # If set to the same name as graphql_single_name, the field name will default to `all${graphql_single_name}`, i.e. `allDocument`.
	'public' => true,
	'publicly_queryable' => true,
	);
	register_taxonomy( 'book-categories', array( 'books' ), $args );

}
add_action( 'init', 'register_book_cats', 0 );

?>
