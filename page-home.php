<?php
/*
 Template Name: Home Page 
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
?>

<?php get_header(); ?>

	 	<div class="w-h-full">

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-4of5 d-5of7 cf c-h-content" role="main" itemscope itemprop="mainContentOfPage">

							<?php get_sidebar( "homepage1" ); ?>

					</main>					

				</div>

			</div>

		</div>

		<?php include 'featured-news.php'; ?>

		<div class="w-h-full">

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage">

							<?php 

								if (function_exists('kgp_strose_gallery_plugin')) {
									kgp_strose_gallery_plugin();
								} else {
									echo '<div class="no-widgets"><h2>St. Rose Gallery widget is not install</h2></div>';
								}

							?>	

					</main>					

				</div>

			</div>

		</div>

		<?php 

			if (function_exists('kgp_strose_event_plugin')) {
				kgp_strose_event_plugin();
			} else {
				echo '<div class="no-widgets"><h2>St. Rose Event wifget is not install</h2></div>';
			}

		?>	

<?php get_footer(); ?>
