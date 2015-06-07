<?php 

function kgp_strose_event_plugin() { ?>

<div class="sub-h-full cf">

	<div id="content">

		<div id="inner-content" class="wrap cf">
		<?php if (function_exists('custom_post_events')) { ?>

		<h1 class="fea-news-title">Upcoming events</h1>

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
						'posts_per_page'		=>	3,
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
							//$event_image= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						?>
							
							<div class="featured-event m-all d-1of3 cf">
								<a href="<?php the_permalink(); ?>">
								<?php printf( __( ' %1$s', 'strose' ),				
                       				'<time class="updated entry-time date-round" datetime="' . date('y-m-d', $event_start_date) . '" itemprop="datePublished"> 
                       				<span class="date-month"><abbr>' . date( 'M', $event_start_date) . '</abbr></span>
                       				<span class="date-day">' . date( 'd', $event_start_date) . '</span>
                       				</time>'
                    			); ?></a>
                    			<div class="event-detail">
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

				<a href="<?php echo get_post_type_archive_link( 'event' ); ?>" class="btn">See all events</a>

		<?php // Restore original Post Data
		wp_reset_postdata();

		?>

		<?php } else { echo '<div class="no-widgets"><h2>Strose events is not install</h2></div>'; } ?>

		</div>

	</div>

</div>

<?php } ?>