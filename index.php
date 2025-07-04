<?php get_header(); ?>

<main id="main" class="site-main">

<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();

        // Obtenemos el valor de la casilla de verificación.
        $hide_title = get_post_meta( get_the_ID(), '_hide_page_title_key', true );

        // Solo mostramos el título si la casilla NO está marcada.
        if ( '1' !== $hide_title ) {
            the_title( '<h2>', '</h2>' );
        }

        the_content();

    endwhile;
else :
    echo '<p>No content found.</p>';
endif;
?>
</main>

<?php get_footer(); ?>
