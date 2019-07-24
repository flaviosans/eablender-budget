<?php
$id = rand(0,999);
$plugin_path = plugin_dir_url( __FILE__ )
?>

<style>
    @media (max-width: 768px) {
        [class*="col-"] {
            width: 100%;
            max-width: 100%;
        }
    }

    .eablender-textarea {
        width: 100%;
        min-height: 150px;
        border: 1px solid #aaaaaa;
    }

    * {
        box-sizing: border-box;
    }

    input.eablender-input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        border: 1px solid #aaaaaa;
    }

    .step-tab {
        display: none;
    }

    button {
        background-color: #fd7d1a;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #606062;
    }

    span.step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #fd7d1a;
        border: none;
        border-radius: 50%;
        display: inline-block !important;
        opacity: 0.5;
    }

    #cep-error {
        display: none;
    }

    @media only screen and (max-width: 989px) {
        div.radio {
            width: 100%;
        }
    }

    @media only screen and (max-width: 766px) {
        div.radio {
            width: 100%;
        }
    }

    .verticalRadio {
        display: block;
        vertical-align: middle;
    }

    input[type="radio"] {
        position: inherit;
        margin-top: 8px;
    }

    input[type="radio"] {
        margin-top: -1px;
        vertical-align: middle;
    }

    .thanks img {
        padding-top: 2rem;
        width: 10%;
    }

    .eablender-h5, .eablender-p {
        text-align: center;
    }

    .button-step {
        margin-top: 3.5rem;
    }

    label {
        display: table;
    }

    .error {
        display: none;
        border: 2px solid red;
    }
    .eablender-icon {
        color: #ff7700;
    }

</style>

<div class="container">
    <div class="step-tab w3-animate-opacity">
        <div class="form-group">
            <label for="budgetZipCode" class="control-label required"><i class="fas fa-map-marked-alt eablender-icon">&nbsp;</i>Insira seu
                CEP, sem pontos nem traços:
                <span id="cep-error" style="font-size: 14px"
                      class="text-danger m-t-5">&nbsp;Cep Inválido!</span></label>
            <input onkeyup="findCep()" type="text" class="form-control eablender-input" maxlength="8"
                   id="budgetZipCode"
                   style="width: 100%" minlength="8"/>

            <div class="form-group">
                <label for="budgetCity" class="control-label"><i class="fas fa-city eablender-icon">&nbsp;</i>Cidade
                    e Estado:</label>
                <input type="text" id="budgetCity" class="form-control eablender-input" readonly/>
            </div>
        </div>
        <div class="form-group">
            <label for="budgetNeighborhood" class="control-label"><i class="fas fa-road"
                                                                     style="color: #ff7700;">&nbsp;</i>Bairro:</label>
            <input type="text" onblur="setNeighborhood(this.value)" id="budgetNeighborhood"
                   class="form-control eablender-input"/>
        </div>
    </div>
    <div class="step-tab w3-animate-opacity">
        <div class="col-12">
            <p class="cfw__title text-center">
                Em qual
                <b>categoria</b>
                o orçamento se encaixa?</p>
        </div>
        <div class="container">

            <form>
                <div class="row">
                    <div class="col-12">
                        <div class="radio">
                            <label><input type="radio" name="optradio"
                                          onclick="addCategory(1)">Construção</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" onclick="addCategory(2)">Reforma</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio"
                                          onclick="addCategory(3)">Decoração</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" onclick="addCategory(4)">Paisagismo e
                                Jardinagem</label>
                        </div>

                        <div class="radio">
                            <label><input type="radio" name="optradio"
                                          onclick="addCategory(5)">Loteamento</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" onclick="addCategory(6)">Projetos em
                                geral</label>
                        </div>

                        <div class="radio">
                            <label><input type="radio" name="optradio" onclick="addCategory(7)">Instalações e
                                serviços</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio"
                                          onclick="addCategory(8)">Pavimentação</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" onclick="addCategory(9)">Mudanças</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" onclick="addCategory(10)">Reparos e
                                Serviços</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" onclick="addCategory(11)">Outros</label>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="step-tab w3-animate-opacity">
        <div class="row">
            <div class="col-sm-12 col-md-6 bc__separete-vertical">
                <p class="cfw__title" style="text-align: center;"><strong>Qual o tipo de imóvel?</strong></p>
                <div class="form-radio m-b-30">
                    <div class="radio ">
                        <label class="verticalRadio">
                            <input type="radio" onclick="setPropertyType('residence')" name="propertyBudget"
                                   value="residence">
                            Residência
                        </label>
                        <label class="verticalRadio">
                            <input type="radio" onclick="setPropertyType('trade')" name="propertyBudget" value="trade">
                            Comércio
                        </label>
                        <label class="verticalRadio">
                            <input type="radio" onclick="setPropertyType('industry')" name="propertyBudget"
                                   value="industry">
                            Indústria
                        </label>
                        <label class="verticalRadio">
                            <input type="radio" onclick="setPropertyType('other')" name="propertyBudget" value="other">
                            Outro
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <p class="cfw__title" style="text-align: center;"><strong>Quando pretende começar?</strong></p>
                <div class="form-radio m-b-30">
                    <div class="radio radiofill radio-primary ">
                        <label class="verticalRadio">
                            <input type="radio" onclick="setStart('afap')" name="startBudget" value="afap">

                            O mais rápido possível
                        </label>
                        <label class="verticalRadio">
                            <input type="radio" onclick="setStart('from_1_to_3_months')" name="startBudget"
                                   value="from_1_to_3_months">

                            De 1 a 3 meses
                        </label>
                        <label class="verticalRadio">
                            <input type="radio" onclick="setStart('more_than_3_months')" name="startBudget"
                                   value="more_than_3_months">

                            Mais de 3 meses
                        </label>
                        <label class="verticalRadio">
                            <input type="radio" onclick="setStart('dont_know')" name="startBudget" value="dont_know">
                            Não sei
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="step-tab w3-animate-opacity">
        <div class="row">
            <div class="col-md-12">
                <p class="cfw__title"><strong>Adicione um
                        título e descrição em seu pedido:</strong></p>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="titleBudget" class="control-label required"> <strong><i class="far fa-edit eablender-icon eablender-icon">&nbsp;</i>Título:</strong></label>
                    <span style="font-size: 14px" class="text-danger m-t-5 error">&nbsp;Título muito curto, por favor descreva melhor!</span>
                    <input id="titleBudget" onblur="setBudgetTitle(this.value)" type="text"
                           class="form-control eablender-input"
                           placeholder="Ex: Quero construir um escritório novo"
                           minlength="1">
                </div>
                <div class="form-group">
                    <label for="descriptionBudget" class="control-label required"><i class="far fa-comments eablender-icon eablender-icon">&nbsp;</i>Descrição:
                        <span style="font-size: 14px"
                              class="text-danger m-t-5 error">&nbsp;Descrição muito curta</span>
                    </label>
                    <textarea onblur="setDescription(this.value)" id="descriptionBudget"
                              class="form-control eablender-textarea" rows="7" minlength="2"
                              placeholder="Adicione os detalhes que você sente necessidade de explicar para o profissional. Quanto mais informações constar, mais rápido será o contato do profissional para te passar a melhor proposta de orçamento."></textarea>
                </div>
            </div>
        </div>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="hourBudget" class="control-label required"><strong>Melhor horário para contato:</strong>
                    </label>
                    <hr style="margin-top: 0.4em;">
                    <div class="form-radio">
                        <div class="radio radiofill radio-primary">
                            <label>
                                <input type="radio" name="hourBudget" id="hourBudget" value="morning"
                                       onclick="setContactHour(this.value)">
                                Manhã
                            </label>
                        </div>
                        <div class="radio radiofill radio-primary">
                            <label>
                                <input type="radio" name="hourBudget" value="afternoon"
                                       onclick="setContactHour(this.value)">
                                Tarde
                            </label>
                        </div>
                        <div class="radio radiofill radio-primary">
                            <label>
                                <input type="radio" name="hourBudget" value="night"
                                       onclick="setContactHour(this.value)">
                                Noite
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="personBudget" class="control-label required"><strong>O pedido é para:</strong></label>
                    <hr style="margin-top: 0.4em;">
                    <div class="form-radio">
                        <div class="radio radiofill radio-primary radio-inline">
                            <label>
                                <input type="radio" onclick="setPersonType(this.value)" name="personBudget"
                                       id="personBudget" value="pf">
                                Pessoa física
                            </label>
                        </div>
                        <div class="radio radiofill radio-primary">
                            <label>
                                <input type="radio" onclick="setPersonType(this.value)" name="personBudget" value="pj">
                                Pessoa jurídica
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="step-tab w3-animate-opacity">
        <div class="row">
            <div class="col-12 bc__separete-vertical">
                <label><strong>Contato</strong></label>
                <div class="form-group">
                    <label for="nameBudget" class="control-label required"><i class="fas fa-user-edit eablender-icon">&nbsp;</i>Nome
                        completo: <span style="font-size: 14px"
                                        class="text-danger m-t-5 error">&nbsp;Nome precisa ter no minimo 5 caracteres</span>
                    </label>
                    <input type="text" onblur="setName(this.value)" class="form-control eablender-input"
                           id="nameBudget" minlength="5">
                </div>

                <div class="form-group">
                    <label for="emailBudget" class="control-label required"><i class="far fa-envelope eablender-icon">&nbsp;</i>E-mail:<span style="font-size: 14px"
                                                                                                                              class="text-danger m-t-5 error">&nbsp;Email inválido</span></label>

                    <div class="input-group">
                        <input type="email" onblur="setEmail(this)" class="form-control eablender-input error-email"
                               id="emailBudget"
                               autocomplete="off">
                        <span class="input-group-addon pd-10">
                            <i class="fa icon-loop"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phoneBudget" class="control-label required"><i class="fas fa-phone eablender-icon"
                                                                                >&nbsp;</i><span style="font-size: 14px"
                                                                                                                      class="text-danger m-t-5 error">&nbsp;Campo obrigatório!</span>Telefone:</label>
                    <input onblur="setPhone(this.value)" onkeyup="maskPhone(this)" type="tel"
                           class="form-control phone eablender-input" id="phoneBudget"
                           name="phoneBudget">
                </div>
            </div>

            <hr>

            <div class="form-group col-12" style="padding-top: 1em;">
                <div class="row">
                    <div class="col-12">
                        <label><strong>Interesse:</strong></label>
                        <select name="interest" id="interest" onclick="setInterest(this.value)" class="form-control"
                        >
                            <option value="">Selecione uma opção</option>
                            <option value="saber_apenas_precos_a_fim_de_comparacao">Saber apenas preços a fim de
                                comparação
                            </option>
                            <option value="tirar_duvidas_para_saber_melhor_o_que_desejo_fazer">Tirar dúvidas para saber
                                melhor o que
                                desejo fazer
                            </option>
                            <option value="negociar_a_execucao_do_servico_com_um_profissional">Negociar a execução do
                                serviço com um
                                profissional
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <form id="estimatedPrice">
                            <hr style="padding: 5px 0 5px 0">
                            <label> <strong>Estimativa de investimento total na obra:</strong></label>
                            <hr style="margin-top: 0.4em;">
                            <div class="radio">
                                <label>
                                    <input type="radio" onclick="setEstimatedPrice(this.value)" id="optradio1"
                                           name="optradio" value="1">
                                    Até R$20.000,00
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" onclick="setEstimatedPrice(this.value)" id="optradio2"
                                           name="optradio" value="2">
                                    Até R$40.000,00
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" onclick="setEstimatedPrice(this.value)" id="optradio3"
                                           name="optradio" value="3">
                                    Até R$80.000,00
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input onclick="setEstimatedPrice(this.value)" type="radio" id="optradio4"
                                           name="optradio" value="4">
                                    Mais de R$80.000,00
                                </label>
                            </div>


                        </form>
                    </div>

                </div>


            </div>

        </div>


    </div>
    <div class="step-tab thanks w3-animate-opacity">
        <img class="img-fluid mx-auto d-block w3-animate-fading"
             src="<?php echo $plugin_path ?>img/checked.png" alt="check-form"> <br>
        <h5 class="eablender-h5">Obrigado!</h5>
        <p class="eablender-p">Em breve um profissional entrará em contato com você!</p>
    </div>
    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" class="button-step" onclick="eablenderBudgetNavigate(-1)">Anterior
            </button>
            <button type="button" id="nextBtn" class="button-step" onclick="eablenderBudgetNavigate(1)">Próximo</button>
        </div>
    </div>
    <div id="step" style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</div>