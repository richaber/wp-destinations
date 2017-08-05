<?php get_header(); ?>
	<main class="main">
		<div class="container">
			<div id="map"></div>
			<script type="text/javascript">
				// Creates two arrays for map latitudes and longitude coordinates
				var locations = [];
				<?php
				while ( have_posts() ) : the_post(); ?>
				<?php if ( esc_attr( get_post_meta( $post->ID, 'wp_destinations_address', true ) ) !== '' ) : ?>
				var item = {
					marker_id: "<?php echo esc_attr(get_the_ID()) ?>",
					marker_address: "<?php echo esc_attr(get_post_meta($post->ID, 'wp_destinations_address', true)) ?>",
					marker_lat: <?php echo esc_attr(get_post_meta($post->ID, 'wp_destinations_latitude', true)) ?>,
					marker_long: <?php echo esc_attr(get_post_meta($post->ID, 'wp_destinations_longitude', true)) ?>
				};
				locations.push(item);
				console.log(item);
				<?php endif; ?>
				<?php endwhile; ?>
			</script>
			<?php if ( have_posts() ) : ?>
				<!-- WordPress has found matching posts -->
				<div id="post-container">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php if ( esc_attr( get_post_meta( $post->ID, 'wp_destinations_address', true ) ) !== '' ) : ?>
							<div id="item_<?php echo get_the_ID(); ?>" class="post-modal-behind">
								<div class="post-modal">
									<div class="modal-header">
										<h3 class='modal-title'> <?php the_title() ?> <span class="close">x</span></h3>
										<h3><?php esc_attr( get_post_meta( $post->ID, 'wp_destinations_address', true ) ) ?></h3>
										<h3><?php esc_attr( get_post_meta( $post->ID, 'wp_destinations_latitude', true ) ) ?></h3>
										<h3><?php esc_attr( get_post_meta( $post->ID, 'wp_destinations_longitude', true ) ) ?></h3>
									</div><!-- Modal Header -->
									<div class="modal-body clearfloat">
										<?php the_content(); ?>
									</div><!-- Modal Body -->
									<div class="modal-footer">
										I'm a Modal Footer!
									</div><!-- Modal Footer -->
								</div><!-- Post Modal -->
							</div><!-- Post Modal Background -->
						<?php endif; ?>
					<?php endwhile; ?>
				</div><!-- Post Container -->
			<?php else : ?>
				<!-- No matching posts, show an error -->
				<h1>Error 404 &mdash; Page not found.</h1>
			<?php endif; echo "<br>" . $i; ?>
		</div><!-- End of Container -->
	</main><!-- End of Main -->
<?php get_footer();