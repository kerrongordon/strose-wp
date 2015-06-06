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

			<div id="content" class="oh">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="history-over m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" >

						<div class="fixlocal"></div>
						<div class="history-line"></div>

							<?php
							  // set up or arguments for our custom query
							  $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
							  $query_args = array(
							    'post_type' 		=> 'history',
							    'order'          	=> 'ASC',
							    'posts_per_page' 	=> -1,
							    'paged' 			=> $paged
							  );
							  // create a new instance of WP_Query
							  $the_query = new WP_Query( $query_args );
							?>

							<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'd-2of5 wow flipInX cf' ); ?> role="article" data-wow-delay="0.5s">

								<div class="post-img">									
									
										<?php the_post_thumbnail( 'bones-thumb-900' ); ?> 										
										<a type="button" href="<?php the_permalink() ?>" class="readmore-h "><span class="dashicons dashicons-hammer"></span></a>
									
								</div>

																	
									<p class="byline entry-meta vcard date-card wow zoomIn">
                                        <?php the_title(); ?>
									</p>


								<section class="entry-content cf">
									<?php the_content(); ?>
								</section>

							</article>

							<?php endwhile; ?>

									<?php //bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class=" cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'strose' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'strose' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the index.php template.', 'strose' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


						</main>


				</div>

			</div>

<?php get_footer(); ?>
