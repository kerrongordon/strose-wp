<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class=" m-all cf" role="main" itemscope itemprop="mainContentOfPage" >

							<?php if (function_exists('custom_post_events')) { ?>

								

							<?php
											//Preparing the query for events
											$meta_quer_args = array(
												'relation'	=>	'AND',
												array(
													'key'		=>	'event-end-date',
													'value'		=>	time(),
													'compare'	=>	'>='
												)
											);

											$query_args = array(
												'post_type'				=>	'event',
												'posts_per_page'		=>	9,
												'post_status'			=>	'publish',
												'ignore_sticky_posts'	=>	true,
												'meta_key'				=>	'event-start-date',
												'orderby'				=>	'meta_value_num',
												'order'					=>	'ASC',
												'cache_results'          => true,
												'update_post_meta_cache' => true,
												'update_post_term_cache' => true,
												'meta_query'			=>	$meta_quer_args
											);

											$upcoming_events = new WP_Query( $query_args ); ?>

											<div class="event-list t-cof60 cf">
											
												<?php while( $upcoming_events->have_posts() ): $upcoming_events->the_post();
													$event_start_date = get_post_meta( get_the_ID(), 'event-start-date', true );
													$event_end_date = get_post_meta( get_the_ID(), 'event-end-date', true );
													$event_venue = get_post_meta( get_the_ID(), 'event-venue', true );
													$event_image= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
												?>
													
													<div id="post-<?php the_ID(); ?>" class="featured-event m-all t-1of2 d-1of3 cf wow fadeInUp">
														<a href="<?php the_permalink(); ?>">
														<?php printf( __( ' %1$s', 'strose' ),				
						                       				'<time class="updated entry-time date-round date-round-big" datetime="' . date('y-m-d', $event_start_date) . '" itemprop="datePublished"> 
						                       				<span class="date-month"><abbr>' . date( 'M', $event_start_date) . '</abbr></span>
						                       				<span class="date-day">' . date( 'd', $event_start_date) . '</span>
						                       				</time>'
						                    			); ?></a>
						                    			<div class="event-detail t-c">
												          <a rel="external" href="<?php the_permalink(); ?>" data-element-location="Upcoming Event Link Clicks" data-link-type="href">
												            <h4><?php echo substr(the_title('', '', FALSE), 0, 25); ?>...</h4>
												          </a>
												          <time class="event-info" datetime="<?php get_the_time('y-m-d') ?>"><span class="dashicons dashicons-calendar-alt"></span> <?php kgp_get_date(); ?></time>
												          <span class="event-info location">
												            <p><span class="dashicons dashicons-location"></span> <?php echo $event_venue; ?></p>
												          </span>
												        </div>
													</div>
												<?php endwhile; ?>
											</div>

										

								<?php // Restore original Post Data
								wp_reset_postdata();

								?>

								<?php } else { echo '<div class="no-widgets"><h2>Strose events is not install</h2></div>'; } ?>

						</main>


				</div>

			</div>

<?php get_footer(); ?>
