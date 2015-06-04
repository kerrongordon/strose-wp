<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" 

						<?php if ( 'gallery' == get_post_format() or 'video' == get_post_format() ) { ?>
							
							class="m-all t-all d-all cf " 

						<?php } else { ?>

							class="m-all t-2of3 d-5of7 cf " 

						<?php } ?>

						role="main" itemscope itemprop="mainContentOfPage" >
											
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								/*
								 * Ah, post formats. Nature's greatest mystery (aside from the sloth).
								 *
								 * So this function will bring in the needed template file depending on what the post
								 * format is. The different post formats are located in the post-formats folder.
								 *
								 *
								 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php" FOR POSTS THAT AREN'T
								 * A SPECIFIC POST FORMAT.
								 *
								 * If you want to remove post formats, just delete the post-formats folder and
								 * replace the function below with the contents of the "format.php" file.
								*/
								if ( 'gallery' == get_post_format() or 'video' == get_post_format() ) {

									get_template_part( 'post-formats/format', get_post_format() );

								} else {

									include 'post-formats/format.php';

								}

							?>

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

					<?php 

						if ( 'gallery' == get_post_format() or 'video' == get_post_format() ) {

							
						    
						} else {

							get_sidebar();
						}

					?>			

				</div>

			</div>

<?php get_footer(); ?>
