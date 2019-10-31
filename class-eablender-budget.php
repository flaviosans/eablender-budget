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

    /*
     * @description: Método que cria um endpoint customizado em wp-json/v1/budgets utilizando o método register_rest_route
     * @author: Jonas Gabriel de Almeida - jgalmeida1993@gmail.com
     * @date: 30/10/2019
     */
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

        // Abre o arquivo especificado
        $fp = fopen(__DIR__ . "\\log\\log-mes-" . date('m') . ".txt", "a") or die("Não foi possível abrir o arquivo");

        // Armazena o Id da categoria do orçamento escolhido
        $categoryId = $budgetString["budgetCategory"]["id"];

        $categoryName = "";
        //  Case para converter o Id da categoria do orçamento em uma String correspondente
            switch ($categoryId) {
                case 1:
                    $categoryName = "Construção";
                    break;
                 case 2:
                    $categoryName = "Reforma";
                     break;
                case 3:
                    $categoryName = "Decoração";
                    break;
                case 4:
                    $categoryName = "Paisagismo";
                    break;
                case 5:
                    $categoryName = "Loteamento";
                    break;
                case 6:
                    $categoryName = "Projetos em geral";
                    break;
                case 7:
                    $categoryName = "Instalações e serviçoces";
                    break;
                case 8:
                    $categoryName = "Pavimentação";
                    break;
                case 9:
                    $categoryName = "Mudanças";
                    break;
                case 10:
                    $categoryName = "Reparos";
                    break;
                case 11:
                    $categoryName = "Outros";
                    break;
                default:
                    echo "Categoria não encontrada";
            }

        $estimatedPriceId = $budgetString["estimatedPrice"];
        $estimatedPriceIdConvertString = "";

        switch ($estimatedPriceId){
            case 1:
                $estimatedPriceIdConvertString = "Até R$20.000,00";
                break;
            case 2:
                $estimatedPriceIdConvertString = "Até R$40.000,00";
                break;
            case 3:
                $estimatedPriceIdConvertString = "Até R$80.000,00";
                break;
            case 4:
                $estimatedPriceIdConvertString = "Mais de R$80.000,00";
                break;
            default:
                $estimatedPriceIdConvertString = "Não informado";
        }

        $message = "Nome: " . $budgetString["userApp"]["name"]  . "\n".
            "Email:" . $budgetString["userApp"]["email"]. "\n" .
            "Telefone: " . $budgetString["userApp"]["phone"]. "\n" .
            "CEP: " .$budgetString["zipCode"]. "\n" .
            "Categoria: " . $categoryName . "\n" .
            "Interesse: "  . str_replace("_", " ", $budgetString["meta"]["interest"]) . "\n\n" .
            "Título orçamento: " . $budgetString["title"] . "\n" .
            "Descrição do orçamento: " . $budgetString["description"] . "\n" .
            "Investimento:" . $estimatedPriceIdConvertString . "\n" .
            "----------------------------------------------------------------------- \n";

        // Escreve no arquivo aberto na linha anterior com os campos selecionados do JSON.
        fwrite($fp, $message);

        // Fecha o arquivo
        fclose($fp);

       

        mail("contato@entendaantes.com.br","Success",
            $message) or die("Não foi possível enviar o email");

        return "Gravado com sucesso!";
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
