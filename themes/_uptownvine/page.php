<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div class="container">
    <div class="interior-container">
        <div class="uv-page-sidebar">
            <?php if ( !function_exists('dynamic_sidebar') ||
                !dynamic_sidebar('Page Sidebar') ) : ?>
                <!-- This will be displayed if the sidebar is empty -->
            <?php endif; ?>
        </div><!-- uv-page-sidebar -->
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                    // Include the page content template.
                    get_template_part( 'content', 'page' );
                    // End the loop.
                endwhile;
                ?>

            </main><!-- .site-main -->
        </div><!-- .content-area -->
    </div>
</div>
<?php get_footer(); ?>
