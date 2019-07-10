# EABlender - Budget

É um plugin da família EABlender, que coleta orçamentos e envia para o [App do Entenda antes](https://app.entendaantes.com.br) 

## O que ele faz?

O EABlender - Budget coleta dados do consumidor interessado em construir/reformar, 
através de um formulário dividido em 5 etapas. Cada uma das etapas contém campos 
obrigatórios.

* Etapa 1:

  * CEP, sem pontos nem traços;
  * Cidade e estado (preenchido automaticamente ao validar o CEP)
  * Bairro (preenchido automaticamente ao validar o CEP)

* Etapa 2:

  * Categoria em que o orçamento se encaixa

* Etapa 3:

  * Qual o tipo de imóvel? 
  
    * Residência
    * Comércio
    * Indústria
    * Outro
  
  * Quando pretende começar?
  
    * O mais rápido possível
    * De 1 a 3 meses
    * Mais de 3 meses
    * Não sei
  
* Etapa 4:

  * Título: uma descrição breve do que o consumidor deseja fazer
  * Descrição: uma descrição mais detalhada do que o consumidor deseja fazer
  * Melhor horário para contato:
  
    * Manhã
    * Tarde
    * Noite
    
  * O pedido é para:
  
    * Pessoa física
    * Pessoa jurídica

* Etapa Final:

  * Nome e sobrenome do consumidor
  * E-mail do consumidor
  * Telefone do consumidor
  * Investimento estimado
    * Até R$ 20 mil
    * Até R$ 40 mil
    * Até R$ 80 mil
  * Interesse
    * Saber apenas preços a fim de comparação
    * Tirar dúvidas para saber melhor o que fazer
    * Negociar a execução do serviço com um profissional  

## Como instalar?

Faça o download do repositório como ZIP e instale no Wordpress

## Como usar?

Insira o shortcode `[eablender-budget]` no lugar onde deve ser exibido o EABlender - Budget

## Como não usar?

O shortcode não pode aparecer duas ou mais vezes numa mesma página

## Requisitos:

* O consumidor não pode avançar para a próxima etapa sem que tenha preenchido todos os campos da etapa atual.

## Erros esperados:
* **API do Entenda Antes inacessível:** O plugin deve retornar uma mensagem ao usuário dizendo que a API está inacessível
* Campos obrigatórios faltantes
  * O plugin deve voltar campo faltante e informar que ele é obrigatório
* Outros erros encontrados devem ser anotados aqui, com suas (prováveis) soluções

## Licença
[Comercial](https://www.example.com/)