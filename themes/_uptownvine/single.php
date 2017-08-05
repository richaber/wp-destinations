<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div class="container interior-container">
	<div id="primary" class="content-area">
        <div class="uv-page-sidebar">
            <?php if ( !function_exists('dynamic_sidebar') ||
                !dynamic_sidebar('Page Sidebar') ) : ?>
                <!-- This will be displayed if the sidebar is empty -->
            <?php endif; ?>
        </div><!-- uv-page-sidebar -->
		<main id="main" class="site-main" role="main">
		<?php // Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() ); ?>
		</main><!-- .site-main -->
        <div class="clearfix"></div>
        <?php // End the loop.
        // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
            comments_template();
            endif;
            // Previous/next post navigation.
            the_post_navigation( array(
            'next_text' => '<h4><span class="meta-nav" aria-hidden="true">' . __( 'Next', 'uptownvine' ) . '</span></h4>' .
            '<span class="screen-reader-text">' . __( 'Next post:', 'uptownvine' ) . '</span> ' .
            '<span class="post-title">%title</span><i class="fa fa-arrow-circle-right fa-3x"></i>',
            'prev_text' => '<h4><span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'uptownvine' ) . '</span></h4>' .
            '<span class="screen-reader-text">' . __( 'Previous post:', 'uptownvine' ) . '</span> ' .
            '<i class="fa fa-arrow-circle-left fa-3x"></i><span class="post-title">%title</span>',
            ) );

        endwhile; ?>
    </div><!-- .content-area -->
    I'm single
</div><!-- .container -->
<?php get_footer(); ?>
