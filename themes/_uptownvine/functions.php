<?php

// Load the main stylesheet
add_action( 'init', 'load_main_stylesheet' );

add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');
// Register the header menu
add_action( 'init', 'register_uv_menus' );

add_action( 'after_setup_theme', 'uv_post_thumbnails' );

add_action( 'widgets_init', 'uv_widgets_init' );

function load_main_stylesheet() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
}
//enqueues our external font awesome stylesheet
function enqueue_our_required_stylesheets(){
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
}
function register_uv_menus() {
    register_nav_menu( 'header-menu',__( 'Header Menu' ));
    register_nav_menu( 'footer-menu',__( 'Footer Menu' ));
}

function uv_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'front-page-imgs', 300, 300, true );
    add_image_size( 'desktop-size-header-bg', 600, 1600, true );}

/**
 * Register our sidebars and widgetized areas.
 *
 */

function uv_widgets_init() {
    register_sidebar( array(
        'name'          => 'Featured Left',
        'id'            => 'feature_left',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar(array(
        'name'          => 'Page Sidebar',
        'id'            => 'page_sidebar',
        'before_widget' => '<div class="page-sidebar">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="sidebar-title">',
        'after_title'   => '</h2>',
    ));
}

function change_header_background() {
    $front_page_background = '/img/header-img.jpg';
    $post_page_background = get_the_post_thumbnail_url();
    if ( is_front_page() ) {
        echo "url(" . get_bloginfo('template_directory') .  $front_page_background . ")";
    }
    else {
        echo "url(" . $post_page_background . ")";
    }
}