<?php

/**
 * Plugin name: Carrousel
 * Author: Taïsha Dorval-Mbele
 * Author URI: https://github.com/xshujo
 * Description: Cette extension carrousel permettra d'afficher dans une boîte modale animée les images d'une galerie
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
    return ("
        <div class='carrousel'>
            <button class='carrousel__x'>X</button>
            <button class='carrousel__image_pre'><</button>
            <button class='carrousel__image_sui'>></button>
            <figure class='carrousel__figure'></figure>
            <form class='carrousel__form'></form>
            <figure class='carrousel__figure'></figure>
        </div> <!-- Fin du carrousel -->
    ");
}
add_shortcode('carrousel', 'creation_carrousel');
