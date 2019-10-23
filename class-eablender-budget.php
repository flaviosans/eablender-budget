<?php

class EABlender_Budget{

	protected $api;

	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'eablender_budget_scripts') );
		add_shortcode( 'eablender-budget', [$this, 'eablender_budget']);
	}

	private function eablender_budget_api_error(){
		?>
		<div class="notice notice-warning">
			<p><?php _e( 'EABlender Pages: EABlender API parece não estar presente' ); ?></p>
		</div>
		<?php
	}

	public function eablender_budget_scripts(){
		wp_enqueue_style( "w3-css", "https://www.w3schools.com/w3css/4/w3.css", null, null, false );
		wp_enqueue_style( "font-google", "https://fonts.googleapis.com/css?family=Raleway", null, null, false );
		wp_enqueue_style( "bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",null, null, false );
		wp_enqueue_script( "bootstrap-js", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js", null, null, false );
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'ea-bridge-step', plugin_dir_url( __FILE__ ) . 'js/step.js', array('jquery'), null, true );
	}

	function eablender_budget($atts = []){
		$value = shortcode_atts( [
			'header' => 'false',
			'userIdToSend' => ''
		], $atts );
		$show = $value['header'];
		
		$userIdToSend = $value['userIdToSend'];

		ob_start();
		include(plugin_dir_path( __FILE__ ) . 'form.php');
		return ob_get_clean();
	}
}