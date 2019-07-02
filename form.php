<?php $plugin_path = plugin_dir_url( __FILE__ )?>




    <div id="thanks" style="display: none">
      <img class="img-fluid mx-auto d-block w3-animate-fading" src="<?php echo $plugin_path?>/img/resized/checked.png" alt="check-form"> <br>
      <h5>Obrigado!</h5>
      <p>Em breve um profissional entrará em contato com você!</p>
    </div>

  <div class="container">
    <div class="step-tab" >
      <div class="form-group">
        <label for="budgetZipCode" class="control-label required">Insira seu CEP, sem pontos nem traços:</label>
        <input onkeyup="findCep()" type="text" class="form-control" maxlength="8" id="budgetZipCode" required
          minlength="9" />
        <span id="cep-error" class="text-danger m-t-5">Cep Inválido!</span>
        <div class="form-group">
          <label for="budgetCity" class="control-label">Cidade e Estado:</label>
          <input type="text" id="budgetCity" class="form-control" readonly required />
        </div>
      </div>
      <div class="form-group">
        <label for="budgetNeighborhood" class="control-label">Bairro:</label>
        <input type="text" onblur="setNeighborhood(this.value)" id="budgetNeighborhood" class="form-control" required />
      </div>
    </div>
    <div class="step-tab">
      <div class="col-12">
        <p class="cfw__title text-center">
          Em qual
          <b>categoria</b>
          o orçamento se encaixa?</p>
      </div>
      <div class="container">
         <div class="row col-md-12 col-sm-12 col-12 w-auto">
              <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(1)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/construction.png">
                  </figure>Construção
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(2)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/reform_new.png">
                  </figure>Reforma
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(3)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/design.png"></figure>
                  Decoração
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(4)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/landscaping.png">
                  </figure>Paisagismo e Jardinagem
                </div>
          </div>
          <div class="row col-md-12 col-sm-12 col-12 w-auto">
              <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(5)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/lot.png"></figure>
                  Loteamento
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(6)">
                  <figure><img class="img-responsive" style="background-color: #0579ff"
                      src="<?php echo $plugin_path?>/img/resized/general_projects.png"></figure>Projetos em geral
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(7)">
                  <figure><img class="img-responsive" style="background-color: #0579ff"
                      src="<?php echo $plugin_path?>/img/resized/facilities_and_services.png"></figure>Instalações e serviços
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(8)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/paving.png"></figure>
                  Pavimentação
                </div>
          </div>
          <div class="row col-md-12 col-sm-12 col-12 w-auto">
              <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(9)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/changes.png">
                  </figure>Mudanças
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(10)">
                  <figure><img class="img-responsive" style="background-color: #0579ff"
                      src="<?php echo $plugin_path?>/img/resized/repairs_and_services.png"></figure>Reparos e serviços
                </div>
                <div class="col-md-3 col-sm-6 col-6 imgBudget hover01" onclick="addCategory(11)">
                  <figure><img class="img-responsive" style="background-color: #0579ff" src="<?php echo $plugin_path?>/img/resized/other.png"></figure>
                  Outros
                </div>
          </div>          
      </div>
    </div>
    <div class="step-tab">
      <div class="row">
        <div class="col-sm-12 col-md-6 bc__separete-vertical">
          <p class="cfw__title" style="text-align: center;"> <strong>Qual o tipo de imóvel?</strong></p>
          <div class="form-radio m-b-30">
            <div class="radio radiofill radio-primary">
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setPropertyType('residence')" name="propertyBudget"
                  value="residence">
                <i class="fa fa-fw fa-check-circle-o"></i>
                Residência
              </label>
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setPropertyType('trade')" name="propertyBudget" value="trade">
                <i class="fa fa-fw fa-check-circle-o"></i>
                Comércio
              </label>
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setPropertyType('industry')" name="propertyBudget"
                  value="industry">
                <i class="fa fa-fw fa-check-circle-o"></i>
                Indústria
              </label>
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setPropertyType('other')" name="propertyBudget" value="other">
                <i class="fa fa-fw fa-check-circle-o"></i>
                Outro
              </label>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <p class="cfw__title" style="text-align: center;"> <strong>Quando pretende começar?</strong></p>
          <div class="form-radio m-b-30">
            <div class="radio radiofill radio-primary">
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setStart('afap')" name="startBudget" value="afap">
                <i class="fa fa-fw fa-check-circle-o"></i>
                O mais rápido possível
              </label>
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setStart('from_1_to_3_months')" name="startBudget"
                  value="from_1_to_3_months">
                <i class="fa fa-fw fa-check-circle-o"></i>
                De 1 a 3 meses
              </label>
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setStart('more_than_3_months')" name="startBudget"
                  value="more_than_3_months">
                <i class="fa fa-fw fa-check-circle-o"></i>
                Mais de 3 meses
              </label>
              <label class="verticalRadio">
                <input type="radio" class="hide" onclick="setStart('dont_know')" name="startBudget" value="dont_know">
                <i class="fa fa-fw fa-check-circle-o"></i>
                Não sei
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="step-tab">
      <div class="row">
        <div class="col-12">
          <p class="cfw__title"><strong>Adicione um título e descrição em seu pedido:</strong> </p>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="titleBudget" class="control-label required"> <strong>Título:</strong></label>
            <input id="titleBudget" onblur="setBudgetTitle(this.value)" type="text" class="form-control"
              placeholder="Ex: Quero construir um escritório novo">
          </div>
          <div class="form-group">
            <label for="descriptionBudget" class="control-label required">Descrição:</label>
            <textarea onblur="setDescription(this.value)" id="descriptionBudget" class="form-control" rows="6"
              placeholder="Adicione os detalhes que você sente necessidade de explicar para o profissional. Quanto mais informações constar, mais rápido será o contato do profissional para te passar a melhor proposta de orçamento."></textarea>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="hourBudget" class="control-label required"><strong>Melhor horário para contato:</strong>
              </label>
              <hr style="margin-top: 0.4em;">
              <div class="form-radio">
                <div class="radio radiofill radio-primary">
                  <label>
                    <input type="radio" name="hourBudget" id="hourBudget" class="hide" value="morning"
                      onclick="setContactHour(this.value)">
                    <i class="fa fa-fw fa-check-circle-o"></i>
                    Manhã
                  </label>
                </div>
                <div class="radio radiofill radio-primary">
                  <label>
                    <input type="radio" name="hourBudget" value="afternoon" class="hide"
                      onclick="setContactHour(this.value)">
                    <i class="fa fa-fw fa-check-circle-o"></i>
                    Tarde
                  </label>
                </div>
                <div class="radio radiofill radio-primary">
                  <label>
                    <input type="radio" name="hourBudget" value="night" class="hide" onclick="setContactHour(this.value)">
                    <i class="fa fa-fw fa-check-circle-o"></i>
                    Noite
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="personBudget" class="control-label required"><strong>O pedido é para:</strong></label>
              <hr style="margin-top: 0.4em;">
              <div class="form-radio">
                <div class="radio radiofill radio-primary radio-inline">
                  <label>
                    <input type="radio" onclick="setPersonType(this.value)" name="personBudget" id="personBudget"
                      value="pf" class="hide">
                    <i class="fa fa-fw fa-check-circle-o"></i>
                    Pessoa física
                  </label>
                </div>
                <div class="radio radiofill radio-primary">
                  <label>
                    <input type="radio" onclick="setPersonType(this.value)" name="personBudget" value="pj" class="hide">
                    <i class="fa fa-fw fa-check-circle-o"></i>
                    Pessoa jurídica
                  </label>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="step-tab">
      <div class="row">
        <div class="col-6 bc__separete-vertical">
          <label><strong>Contato</strong></label>
            <div class="form-group">
              <label for="nameBudget" class="control-label required">Nome e Sobrenome:</label>
              <input type="text" onblur="setName(this.value)" class="form-control" id="nameBudget">
            </div>
            <div class="form-group">
              <label for="emailBudget" class="control-label required">E-mail:</label>
              <div class="input-group">
                <input type="email" onblur="setEmail(this.value)" class="form-control" id="emailBudget" autocomplete="off">
                <span class="input-group-addon pd-10" placement="left" ngbTooltip="Clique aqui para trocar o email"
                  (click)="clearEmail()" *ngIf="showInputPassword">
                  <i class="fa icon-loop"></i>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="phoneBudget" class="control-label required">Telefone:</label>
              <input onblur="setPhone(this.value)" type="tel" class="form-control phone" id="phoneBudget" name="phoneBudget"
                 >
            </div>
          </div>
        <div class="col-6">
            <form id="estimatedPrice" class="form-check-inline" name="estimatedPrice">
              <div class="form-row">
                <div class="col-md-12">
                  <label> <strong>Investimento estimado</strong></label>
                  <hr style="margin-top: 0.4em;">
                  <div class="form-radio">
                    <div class="radio form-radio form-row form-check form-check-inline">
                      <label class="form-check-label" style="padding-left: 0.5em; padding-right: 1.6em;">
                        <input type="radio" onclick="setEstimatedPrice(this.value)" class="form-check-input hide"
                          id="optradio1" name="optradio" value="1">
                        <i class="fa fa-fw fa-check-circle-o"></i>Até R$20.000,00
                      </label>
                      <label class="form-check-label" style="padding-left: 0.5em; padding-right: 1.5em;"><input
                          type="radio" onclick="setEstimatedPrice(this.value)" class="form-check-input hide"
                          id="optradio2" name="optradio" value="2">
                        <i class="fa fa-fw fa-check-circle-o"></i>Até R$40.000,00
                      </label>
                    </div>
                    <div class="radio form-radio form-row form-check form-check-inline">
                      <label class="form-check-label" style="padding-left: 0.5em; padding-right: 1.5em;">
                        <input type="radio" onclick="setEstimatedPrice(this.value)" class="form-check-input hide"
                          id="optradio3" name="optradio" value="3">
                        <i class="fa fa-fw fa-check-circle-o"></i>Até R$80.000,00
                      </label>
                      <label class="form-check-label" style="padding-left: 0.5em; padding-right: 1.5em;">
                        <input onclick="setEstimatedPrice(this.value)" type="radio" class="form-check-input hide"
                          id="optradio4" name="optradio" value="4">
                        <i class="fa fa-fw fa-check-circle-o"></i>Mais de R$80.000,00
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <hr>
            <div class="form-group col-12" style="padding-top: 1em;">
                <label><strong>Interesse:</strong></label>
                <select name="interest" id="interest" onclick="setInterest(this.value)" class="form-control">
                  <option value="">Selecione uma opção</option>
                  <option value="saber_apenas_precos_a_fim_de_comparacao">Saber apenas preços a fim de comparação</option>
                  <option value="tirar_duvidas_para_saber_melhor_o_que_desejo_fazer">Tirar dúvidas para saber melhor o que desejo fazer</option>
                  <option value="negociar_a_execucao_do_servico_com_um_profissional">Negociar a execução do serviço com um profissional</option>
                </select>
              </div>
          </div>
      </div>
    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Proximo</button>
      </div>
    </div>
    <div id="step" style="text-align:center;margin-top:40px;">
      <span  class="step"></span>
      <span  class="step"></span>
      <span  class="step"></span>
      <span  class="step"></span>
      <span  class="step"></span>
    </div>
  </div>