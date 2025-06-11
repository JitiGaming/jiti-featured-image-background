<?php
/*
Plugin Name: Jiti - Featured Image Background
Description: Utilise l'image mise en avant comme fond de page (plein écran, fixe et avec un effet flou), sauf sur la page d'accueil.
Version: 1.1
Author: Jiti
Author URI: https://jiti.me
License: Copyleft
*/

if (!defined('ABSPATH')) exit;

function fbbg_blur_body_background_css() {
    // Exclure la page d'accueil (front page)
    if (is_singular() && !is_front_page()) {
        global $post;
        $img_id = get_post_thumbnail_id($post->ID);
        if ($img_id) {
            $img_url = wp_get_attachment_image_url($img_id, 'full');
            if ($img_url) {
                ?>
                <style>
                body {
                    position: relative;
                    z-index: 0;
                }
                body::before {
                    content: '';
                    position: fixed;
                    top: 0; left: 0; width: 100vw; height: 100vh;
                    z-index: -1;
                    background: url('<?php echo esc_url($img_url); ?>') no-repeat center center fixed;
                    background-size: cover;
                    filter: blur(25px);
                    pointer-events: none;
                    opacity: 1;
                }
                </style>
                <?php
            }
        }
    }
}
add_action('wp_head', 'fbbg_blur_body_background_css');