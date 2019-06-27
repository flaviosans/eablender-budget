var budget = new Object();
budget.budgetCategory = new Object();
budget.budgetSubCategory = new Object();
budget.meta = new Object();
budget.userApp = new Object();
budget.meta.userApp = new Object();
budget.meta.questions = new Object();
var currentTab = 0;

$(document).ready(function(){
  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };

  $('#phoneBudget').mask(SPMaskBehavior, spOptions);
});


function sendBudget(){
    var x = new XMLHttpRequest();
    x.onreadystatechange=function(){
        if(this.readyState == 4 && (this.status == 200 || this.status == 201)){
          clearAll();
        } else {
          showError(x.responseText);
        }
    }

    x.open('post', 'http://localhost:8080/budget');
    x.setRequestHeader('Content-type', 'application/json');
    x.send(JSON.stringify(budget)); 
}

function showError(response){
  var ops = document.getElementById('thanks');
  ops.style.display = "block";
  ops.innerHTML = response;
}



function clearAll(){
   Document.getElementById('ea-form-budget').reset();
}

showTab(currentTab);

function showTab(n) {
  var steptab = document.getElementsByClassName("step-tab");
  steptab[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (steptab.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Finalizar";
  } else {
    document.getElementById("nextBtn").innerHTML = "Próximo";
  }
  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("step-tab");
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  if (currentTab >= x.length){
    $('#phoneBudget').unmask();
    sendBudget();
    showThanks();
    return false;
  }

showTab(currentTab);
}

function showThanks(){
  var thanks = document.getElementById("thanks");
  var next = document.getElementById("nextBtn");
  var previous = document.getElementById("prevBtn");
  var title = document.getElementById("titulo");
  var step = document.getElementById("step");

  step.style.display = "none";
  title.style.display = "none";
  next.style.display = "none";
  previous.style.display = "none";
  thanks.style.display = "block";
  thanks.style.zIndex = 1000;

}

function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}

function findCep(){
  var b = document.getElementById('budgetZipCode').value;
  var cepError = document.getElementById('cep-error');
  if(isNaN(b)){
      
  }
  var x = new XMLHttpRequest();
  x.onreadystatechange=function(){
      if(this.readyState == 4 && this.status == 200){
          cepError.style.display = 'none';
          var cep = JSON.parse(this.responseText);
         if(cep.erro == true){
            cepError.style.display = 'inline';
         } else {
             document.getElementById('budgetCity').value = cep.localidade;
             budget.city = cep.localidade;
             budget.state = cep.uf;
         }
      }
  }
  if(b.length == 8){
    var rightCep = b.substring(0,5)+'-'+b.substring(5,8); 
    budget.zipCode = rightCep;
    x.open('get', `https://viacep.com.br/ws/${rightCep}/json/`);
    x.send();
  }      
}

function addCategory(id){
    budget.budgetCategory.id = id;
    budget.budgetSubCategory.id = 79;
    nextPrev(1);
}

function setPropertyType(property_type){
    budget.meta.questions.property_type = property_type;
    if(budget.meta.questions.start)
        nextPrev(1);
}

function setStart(start){
    budget.meta.questions.start = start;
    if(budget.meta.questions.property_type)
        nextPrev(1);
}

function setBudgetTitle(bt){
    budget.title = bt;
}

function setDescription(d){
    budget.description = d;
}

function setName(n){
    budget.meta.userApp.name = n;
    budget.userApp.name = n;
}

function setEmail(e){
    budget.meta.userApp.email = e;
    budget.userApp.email = e;
}

function setPhone(p){
    budget.meta.userApp.phone = p;
    budget.userApp.phone = p;
}

function setNeighborhood(n){
    budget.neighborhood = n;
}

function setPersonType(pt){
    budget.meta.questions.person_type = pt;
}

function setContactHour(ch){
    budget.meta.questions.contact_hour = ch;
}

function setEstimatedPrice(ep){
    budget.estimatedPrice = ep;
}

function setInterest(interest){
    budget.meta.interest = interest;
}
