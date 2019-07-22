<?php

class EABlender_Budget{

	protected $api;

	public function __construct() {
	    $bridge = null;
	    if(class_exists('EABlender_API')){
	        $bridge = EABlender_API::get_instance();
        } else {
	        echo "Não tem essa classe aí não parça";
        }
		add_action('wp_enqueue_scripts', array($this, 'eablender_budget_scripts') );
		add_shortcode( 'eablender-budget', [$this, 'eablender_budget']);
		if(class_exists('EABlender_API')){
			$this->api = EABlender_API::get_instance();
		}
	}

	public function eablender_budget_scripts(){
		wp_enqueue_style( "w3-css", "https://www.w3schools.com/w3css/4/w3.css", null, null, false );
		wp_enqueue_style( "font-google", "https://fonts.googleapis.com/css?family=Raleway", null, null, false );
		wp_enqueue_style( "bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",null, null, false );
//		wp_enqueue_style( "ea-bridge-step", plugin_dir_url( __FILE__ ) . 'css/step.css', null, null, false );
		wp_enqueue_script( "bootstrap-js", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js", null, null, false );
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'ea-bridge-step', plugin_dir_url( __FILE__ ) . 'js/step.js', array('jquery'), null, true );
	}

	function get_string_from_path($path){
		ob_start();
		include(plugin_dir_path( __FILE__ ) . $path);
		return ob_get_clean();
	}

	function eablender_budget(){
		return $this->get_string_from_path( 'form.php');
	}
}