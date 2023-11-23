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
                <button onclick="prec()" class="precedent">&lt;</button>
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
                <button onclick="suiv()" class="suivant">&gt;</button>
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
