<?php
/*
 Template Name: Contact Page
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/

 //fimg class for face image
?>

<?php get_header(); ?>

			<div id="content" class=" " style="height: auto;">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-5of7 aligncenter cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						
							<div class="wow fadeInLeft">
								<?php echo do_shortcode( '[contact-form-7 id="165" title="Contact form 1"]' ); ?>

							</div>

						</main>
										
				</div>

			</div>

<?php get_footer(); ?>
