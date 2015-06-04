				<div id="homepagemain" class="homepagemain m-all cf" role="complementary">

						<?php if ( is_active_sidebar( 'homepage1' ) ) : ?>

							<?php dynamic_sidebar( 'homepage1' ); ?>

						<?php else : ?>

							<?php
								/*
								 * This content shows up if there are no widgets defined in the backend.
								*/
							?>

							<div class="no-widgets">
								<p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'strose' );  ?></p>
							</div>

						<?php endif; ?>

				</div>
