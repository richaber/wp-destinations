<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>
		<?php wp_head(); ?>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/init.js"></script>
        <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	</head>
	<body <?php body_class(); ?>>
        <div class="outer-container">
            <header class="header" style="background-image: <?php echo change_header_background(); ?>">
                <?php
                if( is_front_page() == false ) {
                    echo "<div class='darken-container'>";
                }
                ?>
                    <nav id="nav_menu" class="nav">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'header-menu',
                        ) );
                        ?>
                    </nav><!-- End Navigation -->
                    <div class="container">
                        <h1 style="display: none;">
                            <a href="<?php echo get_option('home'); ?>">
                                <?php bloginfo('name'); ?></a>
                        </h1>
                        <div class="logo-container">
                            <p>
                                <img src="<?php echo get_bloginfo('template_directory') ?>/assets/img/logo.png" alt="Logo">
                            </p>
                        </div>
                        <div class="description">
                            <h2 class="header-titles">
                               <?php
                                    if( is_front_page() ) {
                                        // Get Header Text
                                    }
                                    else {
                                        echo get_the_title();
                                    }
                                ?>
                            </h2>
                        </div>
                    </div><!-- End Inner Container -->
            <?php
                if ( is_front_page() == false ) {
                    echo "</div><!-- Darken Container -->";
                }
            ?>
            </header><!-- End Header -->