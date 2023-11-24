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

//Zone carrousel d'images des professeurs 
function affichage_galerie()
{
    $query = new WP_Query(array('category_name' => 'professeurs'));

    if ($query->have_posts()) :
?>
        <div class="mainProf">
            <div class="carousel">
                <button onclick="prec()" class="precedent"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg></button>
                <div class="zoneProfs">
                    <?php
                    while ($query->have_posts()) : $query->the_post();

                    ?>
                        <figure class="prof__figure" id="fig_<?php the_id() ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </figure>
                    <?php
                    endwhile;
                    ?>
                </div>
                <button onclick="suiv()" class="suivant"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg></button>
            </div>
        </div>
        <!-- Zone textes des professeurs -->
        <div class="description">
            <?php
            $query = new WP_Query(array('category_name' => 'professeurs'));

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <section class="prof__section" id="des_<?php the_id(); ?>">
                        <figure class="prof__figure" id="fig_<?php the_id() ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </figure>
                        <?php the_content(); ?>
                    </section>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <form class="radiobouton"></form>
<?php
    endif;
    wp_reset_postdata();
}

add_shortcode('galerie', 'affichage_galerie');
