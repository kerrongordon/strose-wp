<?php
/*
 * CUSTOM POST TYPE TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-5of7 aligncenter cf" role="main" itemscope itemprop="mainContentOfPage" >

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php 

							$event_start_date = get_post_meta( get_the_ID(), 'event-start-date', true );
							
							?>

							<div class="featured-event m-all wow fadeInUp cf">
								<a href="<?php the_permalink(); ?>">
								<?php printf( __( ' %1$s', 'strose' ),				
                       				'<time class="updated entry-time date-round date-round-big" datetime="' . date('y-m-d', $event_start_date) . '" itemprop="datePublished"> 
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
						            <p><span class="dashicons dashicons-location"></span> <?php echo get_post_meta( get_the_ID(), 'event-venue', true ); ?></p>
						          </span>
						          <div class="">
						          	<p><i class="dashicons dashicons-admin-post"></i> <?php the_content(); ?></p>
						          </div>
						        </div>
							</div>

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'strose' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'strose' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'strose' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

						<?php //get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
