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
        
        $userIdToSend = $value['userIdToSend'];
        include(plugin_dir_path(__FILE__) . 'form.php');
        return ob_get_clean();
    }

    /*
     * @description: método de callback do método construct_endpoint() - Este método captura
     * os parâmetros da requisição que é enviada pelo JavaScript (step.js), armazena essas
     * informações em um arquivo .txt e envia um email para backup
     *
     * @author: Jonas Gabriel de Almeida - jgalmeida1993@gmail.com
     * @date: 30/10/2019
     */

    function ea_budgets(WP_REST_Request $request)
    {
        // Captura as informações da requisição
        $parameters = $request->get_params();
        $budgetString = $parameters;
        // Transforma os parâmetros em JSON forçando torná-lo em objeto
        print_r($budgetString , json_encode($budgetString, JSON_PRETTY_PRINT, JSON_FORCE_OBJECT));

        // Configurações para o envio de emails
        $to = "jgalmeida1993@gmail.com";
        $subject = "Backup de log";
        $message = "Nome: " . $budgetString["userApp"]["name"];
        $header = "MIME-Version: 1.1\n";
        $header .= "Content-type: text/html; charset=iso-8859-1\n";
        $header .= "From: jonas.grupoaes@gmail.com\n";

        mail($to, $subject, $message, $header);

        // Abre o arquivo especificado
        $fp = fopen(__DIR__ . "\\log\\log-mes-" . date('m') . ".txt", "a") or die("Não foi possível abrir o arquivo");

        // Escreve no arquivo aberto na linha anterior com os campos selecionados do JSON.
        fwrite($fp,
            "Nome: " . $budgetString['userApp']['name']  . "\n".
            "Email: " . $budgetString['userApp']['email']. "\n" .
            "Telefone: " . $budgetString['userApp']['phone']. "\n" .
            "CEP: " .$budgetString['userApp']['address']['zip_code']. "\n" .
            "Categoria: " . $budgetString['budgetCategory']['name'] . "\n" .
            "Interesse: " . str_replace("_", " ", $budgetString['meta']['interest']) . "\n\n" .
            "Título orçamento: " . $budgetString['title'] . "\n" .
            "Descrição do orçamento: " . $budgetString['description'] . "\n" .
            "\n ----------------------------------------------------------------------- \n");

        // Fecha o arquivo
        fclose($fp);

        return $budgetString;
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
