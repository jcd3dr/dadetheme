<?php

function dadecore_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'dadecore-theme' ),
    ) );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'dadecore_theme_setup' );

function dadecore_theme_scripts() {
    wp_enqueue_style( 'dadecore-theme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'dadecore-theme-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@700&display=swap' );
}
add_action( 'wp_enqueue_scripts', 'dadecore_theme_scripts' );

?>