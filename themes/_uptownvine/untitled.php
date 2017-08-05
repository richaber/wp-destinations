	
<script type="text/javascript">
	// Creates two arrays for map latitudes and longitude coordinates
	var map_lats = [];
	var map_longs = [];
	<?php  $i = -1;
	while ( have_posts() ) : the_post(); ?>
		<?php if ( get_geocode_latlng( $post->ID ) !== '' ) : ?>
			// Takes in map latitudes and longitudes from PHP 
			var new_map_lats = map_lats.push(<?php echo get_geocode_lat( $post->ID );  ?>);
			var new_map_longs = map_longs.push(<?php echo get_geocode_lng( $post->ID ); ?>);	
	<?php endif; ?>
	<?php echo $i; ?><br>
	<?php $i++; endwhile; ?><br>
</script>
