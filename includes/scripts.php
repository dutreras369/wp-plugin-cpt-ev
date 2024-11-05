<?php

// Admin
function enqueue_admin_bootstrap() {
    wp_enqueue_style('cpt-style', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), '1.0.0');
    wp_enqueue_script('cpt-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', array(), '1.0.0', true);
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_admin_bootstrap');
