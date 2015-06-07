<?php 

function kgp_strose_gallery_plugin() { 
	$query_gallery = array(
		'post_type'				 =>	'gallery',
		'posts_per_page'		 =>	4,
		'cache_results'          => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => true
	);

  $galleryPosts = new WP_Query( $query_gallery );

   if ($galleryPosts->have_posts()) : while ($galleryPosts->have_posts()) : $galleryPosts->the_post(); ?>
		
		<div class="m-all t-1of2 d-1of4 t-c cf">
   			<span class="img-round h-img-round">
   				<?php the_post_thumbnail( 'bones-thumb-200' ); ?>
               <span class="round-test"><a href="<?php the_permalink(); ?>"><h1 class="h2 entry-title"><?php echo substr(the_title('', '', FALSE), 0, 15); ?>...</h1></a></span>
   			</span>
   		</div>

   	<?php endwhile;

   		else :
   			 echo '<div class="no-widgets"><h2>Add some photos to Gallery</h2></div>';
   	endif;

} ?>