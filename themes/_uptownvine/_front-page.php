<?php get_header(); ?>
<main class="main">
    <div class="container">
            <div id="map"></div>
            <script type="text/javascript">
                // Creates two arrays for map latitudes and longitude coordinates
                var map_lats = [];
                var map_longs = [];
                var marker_ID = [];
                var marker_content = [];
                <?php  $i = -1;
                while ( have_posts() ) : the_post(); ?>
                    <?php if ( esc_attr( get_post_meta( $post->ID, 'wp_destinations_address', true ) ) !== '' ) : ?>
                        var new_map_lats = map_lats.push(<?php echo esc_attr( get_post_meta( $post->ID, 'wp_destinations_latitude', true ) )  ?>);
                        var new_map_longs = map_longs.push(<?php echo esc_attr( get_post_meta( $post->ID, 'wp_destinations_longitude', true ) ) ?>);
                        var new_marker_ID = marker_ID.push(<?php echo esc_attr( get_the_ID() ) ?>);
                        var new_marker_content = marker_content.push("<?php echo the_content( $post ->ID ) ?>");
                <?php endif; ?>
                <?php $i++; endwhile; ?>
            </script>
            <?php if ( have_posts() ) : ?>
            <!-- WordPress has found matching posts -->

                <?php $i = -1; ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php if ( esc_attr( get_post_meta( $post->ID, 'wp_destinations_address', true ) ) !== '' ) : ?>
                        <div id="item<?php echo $i; ?>">
                            <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                            <?php the_content(); ?>
                            <?php echo "<h3>" . esc_attr( get_the_ID() ) . "</h3>"; ?>
                            <?php echo "<h3>" . esc_attr( get_post_meta( $post->ID, 'wp_destinations_address', true ) ) . "</h3>"; ?>
                            <?php echo "<h3>" . esc_attr( get_post_meta( $post->ID, 'wp_destinations_latitude', true ) ) . "</h3>"; ?>
                            <?php echo "<h3>" . esc_attr( get_post_meta( $post->ID, 'wp_destinations_longitude', true ) ) . "</h3>"; ?>
                        </div>
                    <?php endif; ?>
                    <?php $i++;	?>
                <?php endwhile; ?>
                <?php
                echo 'Current PHP version: ' . phpversion();
                ?>
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">x</span>
                        <p></p>
                    </div>

                </div>
            <?php else : ?>
                <!-- No matching posts, show an error -->
                <h1>Error 404 &mdash; Page not found.</h1>
            <?php endif; echo "<br>" . $i; ?>
		</div><!-- End of Container -->
</main><!-- End of Main -->
<?php get_footer();