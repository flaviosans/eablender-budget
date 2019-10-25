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

    function construct_endpoint() {
        register_rest_route('budget/v1', 'budgets',
            [
                'methods' => 'GET', 'POST',
                'callback' => __CLASS__ . '::ea_budgets'
            ]);
    }


    function eablender_budget($atts = [])
    {
        $value = shortcode_atts(['header' => 'false'], $atts);
        $show = $value['header'];
        ob_start();
        include(plugin_dir_path(__FILE__) . 'form.php');
        return ob_get_clean();
    }

    private function eablender_budget_api_error()
    {
        ?>
        <div class="notice notice-warning">
            <p><?php _e('EABlender Pages: EABlender API parece não estar presente'); ?></p>
        </div>
        <?php
    }


    function ea_budgets()
    {
        $file = 'file.txt';


        $json_str = ' {
    "budgetCategory": {
        "id": 3
    },
    "budgetSubCategory": {
        "id": 79
    },
    "meta": {
        "userApp": {
            "name": "flari aoru o",
            "email": "alriuaoiu@aliruoa.com",
            "phone": "4335345987"
        },
        "questions": {
            "ibge": "4124103",
            "start": "more_than_3_months",
            "property_type": "residence",
            "contact_hour": "afternoon",
            "person_type": "pj"
        },
        "interest": "saber_apenas_precos_a_fim_de_comparacao"
    },
    "userApp": {
        "name": "flari aoru o",
        "email": "alriuaoiu@aliruoa.com",
        "phone": "4335345987"
    },
    "city": "Santo Antônio da Platina",
    "neighborhood": "",
    "state": "PR",
    "zipCode": "86430-000",
    "title": "Falfioa ",
    "description": "aliuasoi sliasjd fasdkl iuh l",
    "estimatedPrice": "2"
}';

        $jsonObj = json_decode($json_str);
        $variavel = $jsonObj;

        return $variavel;
    }


}