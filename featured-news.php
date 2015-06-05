<div class="sub-h-full cf">

	<div id="content">

		<div id="inner-content" class="wrap cf">

		<h1 class="fea-news-title">Featured News</h1>
	
	<?php 

	// WP_Query arguments
	$args = array (
		'pagename'               => 'news',
		'posts_per_page'         => '3',
		'orderby'                => 'date',
		'meta_key'               => '_thumbnail_id',
		'cache_results'          => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => true,
	);

	// The Query
	$post_query = new WP_Query( $args );

	// The Loop
	if ( $post_query->have_posts() ) {
		while ( $post_query->have_posts() ) {
			$post_query->the_post(); ?>
		
		
			<article class="featured-post hentry">
				<a href="<?php the_permalink(); ?>"></a>
				<div class="post-img">									
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'bones-thumb-450' ); ?> 
						
						<?php }	else { ?>
						
					<?php }
					?>
				</div>

				<header class="article-header">
					<a href="<?php the_permalink(); ?>"><h1 class="h2 entry-title"><?php echo substr(the_title('', '', FALSE), 0, 15); ?>...</h1></a>				
					<p class="byline entry-meta vcard">
		                    <?php printf( __( 'Posted %1$s by %2$s', 'strose' ),
		                    /* the time the post was published */
		                    '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
		                    /* the author of the post */
		                    '<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
		                    ); ?>
						</p>
				</header>

				<section class="entry-content cf">
					<p><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,20); ?></p>
				</section>

			</article>

		<?php	}
		} else { ?>
			<h1 class="no-widgets">No Featured News Found</h1>
		<?php }

		// Restore original Post Data
		wp_reset_postdata();

		?>

		</div>

	</div>

</div>