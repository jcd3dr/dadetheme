<?php
/**
 * La plantilla para mostrar la página de inicio estática.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TuNombreDeTema
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php
    // El Loop de WordPress para obtener el contenido de la página.
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();

            /**
             * NO mostramos el título visible (H1) en la página de inicio.
             * La función the_title() está intencionadamente comentada u omitida.
             * El título para SEO (<title>) ya se maneja en el header.php con wp_head().
             */
            // the_title( '<h1 class="entry-title">', '</h1>' );

            // Mostramos el contenido que creaste en el editor de Gutenberg.
            the_content();

        endwhile;
    endif;
    ?>

</main><?php get_footer(); ?>
