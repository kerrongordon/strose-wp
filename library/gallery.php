<?php
// Register Custom Post Type
function gallery__post_type() {

	$labels = array(
		'name'                => _x( 'Gallerys', 'Post Type General Name', 'strose_gallery' ),
		'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'strose_gallery' ),
		'menu_name'           => __( 'Gallery', 'strose_gallery' ),
		'name_admin_bar'      => __( 'Gallery', 'strose_gallery' ),
		'parent_item_colon'   => __( 'Parent Item:', 'strose_gallery' ),
		'all_items'           => __( 'All Gallery', 'strose_gallery' ),
		'add_new_item'        => __( 'Add New Item', 'strose_gallery' ),
		'add_new'             => __( 'Add New Gallery', 'strose_gallery' ),
		'new_item'            => __( 'New Gallery', 'strose_gallery' ),
		'edit_item'           => __( 'Edit Gallery', 'strose_gallery' ),
		'update_item'         => __( 'Update Gallery', 'strose_gallery' ),
		'view_item'           => __( 'View Gallery', 'strose_gallery' ),
		'search_items'        => __( 'Search Gallery', 'strose_gallery' ),
		'not_found'           => __( 'Not found', 'strose_gallery' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'strose_gallery' ),
	);
	$args = array(
		'label'               => __( 'gallery', 'strose_gallery' ),
		'description'         => __( 'gallery', 'strose_gallery' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'comments', 'post-formats', 'thumbnail' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-images-alt2',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'gallery', $args );

}

// Hook into the 'init' action
add_action( 'init', 'gallery__post_type');


add_filter( 'option_default_post_format', 'custom_default_post_format' );

function custom_default_post_format( $format ) {
    global $post_type;

    if( $post_type == 'gallery' ) {
        $format = 'gallery';
    }

    return $format;
}


?>