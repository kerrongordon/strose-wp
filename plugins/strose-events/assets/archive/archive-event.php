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

							

							<div class="entry-content hentry"> 
								<table>
									<thead>
										<tr>
											<th>Date</th>
											<th>Event</th>
											<th>Location</th>
										</tr>
									</thead>
									<tbody>
										<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										<tr id="post-<?php the_ID(); ?>">
											<td><?php kgp_get_date(); ?></td>
											<td><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></td>
											<td><?php echo get_post_meta( get_the_ID(), 'event-venue', true ); ?></td>
										</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>

							

									<?php bones_page_navi(); ?>

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
