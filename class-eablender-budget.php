<?php

class EABlender_Budget
{

    protected $api;

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'construct_endpoint']);
        add_action('wp_enqueue_scripts', array($this, 'eablender_budget_scripts'));
        add_shortcode('eablender-budget', [$this, 'eablender_budget']);
    }

    public function eablender_budget_scripts()
    {
        wp_enqueue_style("w3-css", "https://www.w3schools.com/w3css/4/w3.css", null, null, false);
        wp_enqueue_style("font-google", "https://fonts.googleapis.com/css?family=Raleway", null, null, false);
        wp_enqueue_style("bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css", null, null, false);
        //		wp_enqueue_style( "ea-bridge-step", plugin_dir_url( __FILE__ ) . 'css/step.css', null, null, false );
        wp_enqueue_script("bootstrap-js", "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js", null, null, false);
        wp_enqueue_script('jquery');
        wp_enqueue_script('ea-bridge-step', plugin_dir_url(__FILE__) . 'js/step.js', array('jquery'), null, true);
    }

    function construct_endpoint()
    {
        register_rest_route(
            'v1',
            'budgets',
            [
                'methods' => 'POST',
                'callback' => __CLASS__ . '::ea_budgets'
            ]
        );
    }

    function eablender_budget($atts = [])
    {
        $value = shortcode_atts(['header' => 'false'], $atts);
        $show = $value['header'];
        ob_start();
        include(plugin_dir_path(__FILE__) . 'form.php');
        return ob_get_clean();
    }

    function ea_budgets(WP_REST_Request $request)
    {

        $parameters = $request->get_params();

        $budgetString = $parameters;
        $jsonObj = json_encode($budgetString);

        $fp = fopen("C:\\xampp\\htdocs\\wordpress-limpo\\wp-content\\plugins\\eablender-budget\\budget.txt", "a") or die("Não foi possível abrir o arquivo");

        fwrite($fp, $jsonObj . "\n");

        fclose($fp);

        return $parameters;
    }

    private function eablender_budget_api_error()
    {
        ?>
        <div class="notice notice-warning">
            <p><?php _e('EABlender Pages: EABlender API parece não estar presente'); ?></p>
        </div>
        <?php
    }
}
