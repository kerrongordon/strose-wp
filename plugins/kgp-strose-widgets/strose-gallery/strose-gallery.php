<?php
// Register Custom Post Type
function gallery_post_type() {

	$labels = array(
		'name'                => _x( 'Gallerys', 'Post Type General Name', 'strose' ),
		'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'strose' ),
		'menu_name'           => __( 'Gallery', 'strose' ),
		'name_admin_bar'      => __( 'Gallery', 'strose' ),
		'parent_item_colon'   => __( 'Parent Item:', 'strose' ),
		'all_items'           => __( 'All Gallery', 'strose' ),
		'add_new_item'        => __( 'Add New Item', 'strose' ),
		'add_new'             => __( 'Add New Gallery', 'strose' ),
		'new_item'            => __( 'New Gallery', 'strose' ),
		'edit_item'           => __( 'Edit Gallery', 'strose' ),
		'update_item'         => __( 'Update Gallery', 'strose' ),
		'view_item'           => __( 'View Gallery', 'strose' ),
		'search_items'        => __( 'Search Gallery', 'strose' ),
		'not_found'           => __( 'Not found', 'strose' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'strose' ),
	);
	$args = array(
		'label'               => __( 'gallery', 'strose' ),
		'description'         => __( 'gallery', 'strose' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'comments', 'post-formats', 'thumbnail' ),
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
	register_post_type( 'gallery', $args, 0 );

}

// Hook into the 'init' action
add_action( 'init', 'gallery_post_type');


add_filter( 'option_default_post_format', 'custom_default_post_format' );

function custom_default_post_format( $format ) {
    global $post_type;

    if( $post_type == 'gallery' ) {
        $format = 'gallery';
    }

    return $format;
}


function strose_gallery_archive( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'gallery' ) ) {
          $archive_template = dirname( __FILE__ ) . '/archive-gallery.php';
     }
     return $archive_template;
}

add_filter( 'archive_template', 'strose_gallery_archive' ) ;


function strose_single_archive($single_template) {
     global $post;

     if ($post->post_type == 'gallery') {
          $single_template = dirname( __FILE__ ) . '/single-gallery.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'strose_single_archive' );

include 'home-gallery.php';

?>