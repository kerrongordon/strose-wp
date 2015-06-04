<?php
/**
 * Plugin Name: St Rose Events
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A brief description of the plugin.
 * Version: 1.0
 * Author: Kerron Gordon
 * Author URI: http://URI_Of_The_Plugin_Author
 * Text Domain: Optional. Plugin's text domain for localization. Example: mytextdomain
 * Domain Path: Optional. Plugin's relative directory path to .mo files. Example: /locale/
 * Network: Optional. Whether the plugin can only be activated network wide. Example: true
 * License: GPL2
 */



	// Register Custom Post Type
	function custom_post_events() {

		$labels = array(
			'name'                => _x( 'Events', 'Post Type General Name', 'strose' ),
			'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'strose' ),
			'menu_name'           => __( 'Events', 'strose' ),
			'parent_item_colon'   => __( 'Parent event:', 'strose' ),
			'all_items'           => __( 'All events', 'strose' ),
			'view_item'           => __( 'View event', 'strose' ),
			'add_new_item'        => __( 'Add New Event', 'strose' ),
			'add_new'             => __( 'Add New Event', 'strose' ),
			'edit_item'           => __( 'Edit Event', 'strose' ),
			'update_item'         => __( 'Update Event', 'strose' ),
			'search_items'        => __( 'Search events', 'strose' ),
			'not_found'           => __( 'Events Not found', 'strose' ),
			'not_found_in_trash'  => __( 'Events Not found in Trash', 'strose' ),
		);
		$args = array(
			'label'               => __( 'event', 'strose' ),
			'description'         => __( 'A list of upcoming events', 'strose' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-calendar-alt',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'event', $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'custom_post_events', 0 );



/**
 * Flushing rewrite rules on plugin activation/deactivation
 * for better working of permalink structure
 */
function sis_activation_deactivation() {
	custom_post_events();
	flush_rewrite_rules();
}
//register_activation_hook( __FILE__, 'sis_activation_deactivation' );
add_action( 'init', 'sis_activation_deactivation' );


//Adding metabox for event information

function sis_add_event_info_metabox() {
	add_meta_box( 'sis-event-info-metabox', __( 'Event Info', 'upcoming-events' ), 'sis_render_event_info_metabox', 'event','side', 'core' );
}
add_action( 'add_meta_boxes', 'sis_add_event_info_metabox' );


/**
 * Rendering the metabox for event information
 * @param  object $post The post object
 */
function sis_render_event_info_metabox( $post ) {
	//generate a nonce field
	wp_nonce_field( basename( __FILE__ ), 'sis-event-info-nonce' );

	//get previously saved meta values (if any)
	$event_start_date = get_post_meta( $post->ID, 'event-start-date', true );
	$event_end_date = get_post_meta( $post->ID, 'event-end-date', true );
	$event_venue = get_post_meta( $post->ID, 'event-venue', true );

	//if there is previously saved value then retrieve it, else set it to the current time
	$event_start_date = ! empty( $event_start_date ) ? $event_start_date : time();

	//we assume that if the end date is not present, event ends on the same day
	$event_end_date = ! empty( $event_end_date ) ? $event_end_date : $event_start_date;

	?>
	<p> 
		<label for="sis-event-start-date"><?php _e( 'Event Start Date:', 'upcoming-events' ); ?></label>
		<input type="text" id="sis-event-start-date" name="sis-event-start-date" class="widefat sis-event-date-input" value="<?php echo date( 'F d, Y', $event_start_date ); ?>" placeholder="Format: February 18, 2014">
	</p>
	<p>
		<label for="sis-event-end-date"><?php _e( 'Event End Date:', 'upcoming-events' ); ?></label>
		<input type="text" id="sis-event-end-date" name="sis-event-end-date" class="widefat sis-event-date-input" value="<?php echo date( 'F d, Y', $event_end_date ); ?>" placeholder="Format: February 18, 2014">
	</p>
	<p>
		<label for="sis-event-venue"><?php _e( 'Event Venue:', 'upcoming-events' ); ?></label>
		<input type="text" id="sis-event-venue" name="sis-event-venue" class="widefat" value="<?php echo $event_venue; ?>" placeholder="eg. Times Square">
	</p>
	<?php
}


/**
 * Enqueueing scripts and styles in the admin
 * @param  int $hook Current page hook
 */
function sis_admin_script_style( $hook ) {
	global $post_type;

	if ( ( 'post.php' == $hook || 'post-new.php' == $hook ) && ( 'event' == $post_type ) ) {

		//wp_register_style( 'jquery-ui-calendar', get_stylesheet_directory_uri() . '/library/css/jquery-ui-1.10.4.custom.min.css', array(), '', 'all' );
		//wp_register_script( 'upcoming-events', get_stylesheet_directory_uri() . '/library/js/upcoming-script.js', array( 'jquery', 'jquery-ui-datepicker' ), false, true );

		wp_register_style('jquery-ui-calendar', plugins_url('assets/css/jquery-ui-1.10.4.custom.min.css',__FILE__ ));
		wp_register_script('upcoming-events', plugins_url('assets/js/upcoming-script.js',__FILE__ ), array( 'jquery', 'jquery-ui-datepicker' ), false, true );

		// enqueue styles and scripts
		wp_enqueue_style( 'jquery-ui-calendar' );
		wp_enqueue_script( 'upcoming-events' );
	}
}
add_action( 'admin_enqueue_scripts', 'sis_admin_script_style' );


/**
 * Enqueueing styles for the front-end widget
 */
function sis_widget_style() {
	if ( is_active_widget( '', '', 'sis_upcoming_events', true ) ) {
		wp_enqueue_style('upcoming-events', get_stylesheet_directory_uri('css/upcoming-events.css', __FILE__));
	}
}
//add_action( 'wp_enqueue_scripts', 'sis_widget_style' );


/**
 * Saving the event along with its meta values
 * @param  int $post_id The id of the current post
 */
function sis_save_event_info( $post_id ) {
	//checking if the post being saved is an 'event',
	//if not, then return
	//if ( 'event' != $_POST['post_type'] ) {
		//return;
	//}

	//checking for the 'save' status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['sis-event-info-nonce'] ) && ( wp_verify_nonce( $_POST['sis-event-info-nonce'], basename( __FILE__ ) ) ) ) ? true : false;

	//exit depending on the save status or if the nonce is not valid
	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	//checking for the values and performing necessary actions
	if ( isset( $_POST['sis-event-start-date'] ) ) {
		update_post_meta( $post_id, 'event-start-date', strtotime( $_POST['sis-event-start-date'] ) );
	}

	if ( isset( $_POST['sis-event-end-date'] ) ) {
		update_post_meta( $post_id, 'event-end-date', strtotime( $_POST['sis-event-end-date'] ) );
	}

	if ( isset( $_POST['sis-event-venue'] ) ) {
		update_post_meta( $post_id, 'event-venue', sanitize_text_field( $_POST['sis-event-venue'] ) );
	}
}
add_action( 'save_post', 'sis_save_event_info' );


/**
 * Custom columns head
 * @param  array $defaults The default columns in the post admin
 */
function sis_custom_columns_head( $defaults ) {
	unset( $defaults['date'] );

	$defaults['event_start_date'] = __( 'Start Date', 'upcoming-events' );
	$defaults['event_end_date'] = __( 'End Date', 'upcoming-events' );
	$defaults['event_venue'] = __( 'Venue', 'upcoming-events' );

	return $defaults;
}
add_filter( 'manage_edit-event_columns', 'sis_custom_columns_head', 10 );

/**
 * Custom columns content
 * @param  string 	$column_name The name of the current column
 * @param  int 		$post_id     The id of the current post
 */
function sis_custom_columns_content( $column_name, $post_id ) {
	if ( 'event_start_date' == $column_name ) {
		$start_date = get_post_meta( $post_id, 'event-start-date', true );
		echo date( 'F d, Y', $start_date );
	}

	if ( 'event_end_date' == $column_name ) {
		$end_date = get_post_meta( $post_id, 'event-end-date', true );
		echo date( 'F d, Y', $end_date );
	}

	if ( 'event_venue' == $column_name ) {
		$venue = get_post_meta( $post_id, 'event-venue', true );
		echo $venue;
	}
}
add_action( 'manage_event_posts_custom_column', 'sis_custom_columns_content', 10, 2 );


function kgp_get_date(  ) {
	$start_date 	= date_i18n( get_option( 'date_format' ), get_post_meta( get_the_ID(), 'event-start-date', true ) );
	$end_date 		= date_i18n( get_option( 'date_format' ), get_post_meta( get_the_ID(), 'event-end-date', true ) );

	if ($start_date === $end_date) {
		echo $start_date;
	} else {
		echo $start_date . " To " . $end_date;
	}
}





function strose_events( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'event' ) ) {
          $archive_template = dirname( __FILE__ ) . '/assets/archive/archive-event.php';
     }
     return $archive_template;
}

add_filter( 'archive_template', 'strose_events' ) ;


function strose_events_single($single_template) {
     global $post;

     if ($post->post_type == 'event') {
          $single_template = dirname( __FILE__ ) . '/assets/single/single-event.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'strose_events_single' );







class event_post_widget extends WP_Widget {
	function event_post_widget() {
		$widget_ops = array( 'description' => __( 'Displays custom post content in a widget', 'event-post-widget' ) );
		$this->WP_Widget( 'event_post_widget', __( 'Content Block', 'event-post-widget' ), $widget_ops );
	}
}