		<?php if ( have_posts() ) : ?>
			<!-- WordPress has found matching posts -->
			<div style="display: none;">
				<?php $i = 1; ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( get_post_meta($post->ID, 'latlng', true) !== '' ) : ?>
						<div id="item<?php echo $i; ?>">
							<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
					<?php $i++;	?>
				<?php endwhile; ?>
			</div>
			<script type="text/javascript">
				var locations = [
					<?php  $i = 1; while ( have_posts() ) : the_post(); ?>
						<?php if ( get_post_meta($post->ID, 'latlng', true) !== '' ) : ?>
							{
								latlng : new google.maps.LatLng<?php echo get_post_meta($post->ID, 'latlng', true); ?>, 
								info : document.getElementById('item<?php echo $i; ?>')
						},
						<?php endif; ?>
					<?php $i++; endwhile; ?>
				];
			</script>
			<div id="map" style="width: 100%; height: 100%;"></div>

		<?php else : ?>
			<!-- No matching posts, show an error -->
			<h1>Error 404 &mdash; Page not found.</h1>
		<?php endif; ?>