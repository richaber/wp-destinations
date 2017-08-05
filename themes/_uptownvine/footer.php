			<div class="featured-posts">
                <div class="container">
                <?php if ( is_active_sidebar( 'feature_left' ) ) : ?>
                    <div id="feature-sidebar" class="primary-sidebar widget-area" role="complementary">
                        <?php dynamic_sidebar( 'feature_left' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
                </div><!-- Container -->
            </div>
            <footer class="footer">
				<div class="footer-top">
                    <nav class="social-nav">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook fa-3x"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter fa-3x"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram fa-3x"></i></a></li>
                        </ul>
                    </nav>
                    <?php
                    wp_nav_menu( array(
                    'theme_location' => 'footer-menu',
                    ) );
                    ?>
                </div>
				<div class="footer-bottom">
                    <h5>Jesse Wollin 2016 &copy; &nbsp; | &nbsp; <a href="www.jessewollin.com">www.jessewollin.com</a></h5>
				</div>
			</footer>
		</div><!-- End Outer Container -->
		<?php wp_footer(); ?>
	</body>
</html>
