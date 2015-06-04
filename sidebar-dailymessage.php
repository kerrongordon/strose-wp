				<div id="subscription" class="subscription m-all cf" role="complementary">

					<div class="wrap">

						<?php if ( is_active_sidebar( 'dailymessage' ) ) : ?>

							<?php dynamic_sidebar( 'dailymessage' ); ?>

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

				</div>
