<?php

/*
   Plugin Name: Custom Post Types EV
   Plugin URI:
   Description: Añade Custom Post Types y Metaboxes
   Version: 1.0
   Author: Espacios Virtuales
   Author URI: https://espaciosvirtuales.cl
   License: GPL2
   License URI: https://www.gnu.org/license/gpl-2.0.html
   Text Domain: scripts
*/ 

// Evita el acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Incluir archivos de clase
require_once plugin_dir_path( __FILE__ ) . 'includes/class-cpt-ev.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-metaboxes-ev.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-cpt-columns-ev.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/scripts.php';


// Inicializar el plugin
function run_custom_post_types_ev() {
    $cpt_ev = new CPT_EV();
    $cpt_ev->init();

    $metaboxes_ev = new Metaboxes_EV();
    $metaboxes_ev->init();

    $columns_ev = new CPT_Columns_EV();
    $columns_ev->init();

}
add_action( 'plugins_loaded', 'run_custom_post_types_ev' );
