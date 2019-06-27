<?php
/**
 * Plugin Name: WP EA Bridge
 * Description: A ponte entre o seu blog e o Entenda Antes
 * Version: 0.1
 * Author: Flávio Santos, Gleydson Parpinelli, Jonas Gabriel
 */


function wp_ea_bridge(){
    include dirname(__FILE__) . '\form.php';
}

function wp_ea_add_scripts(){
    wp_enqueue_script( 'ea-bridge-step', plugin_dir_url( __FILE__ ) . 'js/step.js', array('jquery'), null, true );
}

add_action( 'wp_enqueue_scripts', 'wp_ea_add_scripts' );

add_shortcode( 'wp-ea-bridge', 'wp_ea_bridge' );