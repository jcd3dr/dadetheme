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

/**
 * Agrega un cuadro de opciones ("meta box") a la pantalla de edición de páginas.
 */
function dadecore_theme_add_page_options_meta_box() {
    add_meta_box(
        'tu_tema_page_options',      // ID único del meta box.
        'Opciones de Página',        // Título del meta box que verá el usuario.
        'tu_tema_page_options_html', // Función que muestra el contenido del meta box.
        'page',                      // Mostrar solo en 'page' (páginas), no en 'post' (entradas).
        'side',                      // Lugar donde aparecerá ('side' o 'normal').
        'default'                    // Prioridad.
    );
}
add_action( 'add_meta_boxes', 'tu_tema_add_page_options_meta_box' );

/**
 * Muestra el HTML del meta box.
 */
function dadecore_theme_page_options_html( $post ) {
    // Obtenemos el valor guardado previamente, si existe.
    $value = get_post_meta( $post->ID, '_hide_page_title_key', true );
    // Añadimos un campo de seguridad (nonce).
    wp_nonce_field( 'tu_tema_save_page_options', 'tu_tema_page_options_nonce' );
    ?>
    <p>
        <input type="checkbox" id="tu_tema_hide_title_field" name="tu_tema_hide_title_field" value="1" <?php checked( $value, '1' ); ?>>
        <label for="tu_tema_hide_title_field">Ocultar Título de la Página</label>
    </p>
    <?php
}

/**
 * Guarda el valor del meta box cuando se guarda la página.
 */
function dadecore_theme_save_page_options( $post_id ) {
    // Verificamos el nonce por seguridad.
    if ( ! isset( $_POST['tu_tema_page_options_nonce'] ) || ! wp_verify_nonce( $_POST['tu_tema_page_options_nonce'], 'tu_tema_save_page_options' ) ) {
        return;
    }

    // Guardamos o borramos el dato según si la casilla está marcada.
    if ( isset( $_POST['tu_tema_hide_title_field'] ) && '1' === $_POST['tu_tema_hide_title_field'] ) {
        update_post_meta( $post_id, '_hide_page_title_key', '1' );
    } else {
        delete_post_meta( $post_id, '_hide_page_title_key' );
    }
}
add_action( 'save_post_page', 'tu_tema_save_page_options' );
