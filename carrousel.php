<?php

/**
 * Plugin name: Carrousel
 * Author: DiversiTIM
 * Author URI: https://cidweb38.sg-host.com/
 * Description: Cette extension carrousel permettra d'afficher une galerie d'image qu'on peut faire défiler horizontalement
 * Version: 1.0.0
 */

function mon_enqueue_css_js()
{
    $version_css = filemtime(plugin_dir_path(__FILE__) . "style.css");
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/carrousel.js");

    wp_enqueue_style(
        'tdm_plugin_carrousel_css',
        plugin_dir_url(__FILE__) . "style.css",
        array(),
        $version_css
    );

    wp_enqueue_script(
        'tdm_plugin_carrousel_js',
        plugin_dir_url(__FILE__) . "js/carrousel.js",
        array(),
        $version_js,
        true
    );
}
add_action('wp_enqueue_scripts', 'mon_enqueue_css_js');

function creation_carrousel()
{
    echo "
        <div class='carrousel'>
            <button class='carrousel__x'>X</button>
            <button class='carrousel__image_pre'>&lt;</button>
            <button class='carrousel__image_sui'>&gt;</button>
            <figure class='carrousel__figure'></figure>
            <form class='carrousel__form'></form>
            <figure class='carrousel__figure'></figure>
        </div> <!-- Fin du carrousel -->
    ";
}

function affichage_galerie()
{

    $args = array(
        'category_name' => 'professeurs',
        'orderby' => 'title', // Tri par titre
        'order' => 'ASC', // Dans l'ordre alphabétique croissant
    );

    $query = new WP_Query($args);

    // Affichage des articles (descriptions des professeurs)
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            if (has_post_thumbnail()) {
                // Affichez les miniatures des articles
?>
                <div>
                    <?php the_post_thumbnail('thumbnail'); ?>
                </div>
<?php
            }
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Aucun article trouvé dans cette catégorie.';
    endif;
}


//add_shortcode('carrousel', 'creation_carrousel');
add_shortcode('galerie', 'affichage_galerie');
