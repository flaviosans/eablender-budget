<?php
/**
 * Plugin Name: EABlender
 * Description: A ponte entre o seu blog e o Entenda Antes
 * Version: 1.0.0
 * Author: Flávio Santos, Gleydson Parpinelli, Jonas Gabriel
 */

function get_string_from_path($path){
	ob_start();
	include(plugin_dir_path( __FILE__ ) .$path);
	return ob_get_clean();
}

function eablender_budget(){
	return get_string_from_path( 'form.php');
}

function eablender_image(){
	return get_string_from_path( 'image.php');
}

function eablender_budget_scripts(){
    wp_enqueue_style( "w3-css", "https://www.w3schools.com/w3css/4/w3.css", null, null, false );
    wp_enqueue_style( "font-google", "https://fonts.googleapis.com/css?family=Raleway", null, null, false );
    wp_enqueue_style( "bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",null, null, false );
    wp_enqueue_style( "ea-bridge-step", plugin_dir_url( __FILE__ ) . 'css/step.css', null, null, false );
    
    wp_enqueue_script( "bootstrap-js", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js", null, null, false );
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'jquery-mask',"https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js", array('jquery'), null, true);
    wp_enqueue_script( 'ea-bridge-step', plugin_dir_url( __FILE__ ) . 'js/step.js', array('jquery'), null, true );
}

add_action( 'wp_enqueue_scripts', 'eablender_budget_scripts' );

add_shortcode( 'eablender-budget', 'eablender_budget' );

add_shortcode('eablender-image', 'eablender_image');