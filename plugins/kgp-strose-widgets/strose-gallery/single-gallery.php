<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-all d-all cf " role="main" itemscope itemprop="mainContentOfPage" >
											
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<a href="<?php echo get_post_type_archive_link( 'gallery' ); ?>" title="Back to Gallery" class"hide-m"><span class="dashicons dashicons-arrow-left-alt goBack"></span> <span class="goBlink">Go back to Gallery</span></a>
							<h1 class="title-page"><?php the_title();?></h1>

							<article id="post-<?php the_ID(); ?>" class="cf" role="article" itemscope >

				                <header class="article-header">

				                </header> <?php // end article header ?>

				                <section class="entry-content cf" itemprop="articleBody">
				                  <?php
				                    // the content (pretty self explanatory huh)
				                    the_content();

				                    /*
				                     * Link Pages is used in case you have posts that are set to break into
				                     * multiple pages. You can remove this if you don't plan on doing that.
				                     *
				                     * Also, breaking content up into multiple pages is a horrible experience,
				                     * so don't do it. While there are SOME edge cases where this is useful, it's
				                     * mostly used for people to get more ad views. It's up to you but if you want
				                     * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
				                     *
				                     * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
				                     *
				                    */
				                    wp_link_pages( array(
				                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'strose' ) . '</span>',
				                      'after'       => '</div>',
				                      'link_before' => '<span>',
				                      'link_after'  => '</span>',
				                    ) );
				                  ?>
				                </section> <?php // end article section ?>

				                <footer class="article-footer">

				                </footer> <?php // end article footer ?>

				              </article> <?php // end article ?>
							<?php //comments_template(); ?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf wow fadeInUp">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'strose' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'strose' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'strose' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</main>


				</div>

			</div>

<?php get_footer(); ?>
