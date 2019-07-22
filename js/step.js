
var budget = new Object();
budget.budgetCategory = new Object();
budget.budgetSubCategory = new Object();
budget.meta = new Object();
budget.userApp = new Object();
budget.meta.userApp = new Object();
budget.meta.questions = new Object();
var currentTab = 0;

function maskPhone(phoneInput){
    var phone = phoneInput.value;
    phone = phone.replace(/\D/g, "")
        .replace(/^(\d{2})(\d)/g, "($1) $2")
        .replace(/(\d)(\d{4})$/, "$1-$2");
    phoneInput.value = phone;
}

function sendBudget() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status === 201) {
            showThanks();
        } else {
            showError(request.responseText);
        }
    }

    // request.open('post', 'https://alpha.entendaantes.com.br:8443/budget');
    request.open('post', 'http://localhost:8080/budget');
    request.setRequestHeader('Content-type', 'application/json');
    request.send(JSON.stringify(budget));
}

function showError(responseText){

}

showTab(currentTab);

function showTab(tabNumber) {
    var stepTab = document.getElementsByClassName("step-tab");
    stepTab[tabNumber].style.display = "block";
    if (tabNumber === 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (tabNumber === (stepTab.length - 2)) {
        document.getElementById("nextBtn").innerHTML = "Finalizar";
    }
    setStepIndicator(tabNumber)
}

function eablenderBudgetNavigate(step) {
    var stepTabs = document.getElementsByClassName("step-tab");
    stepTabs[currentTab].style.display = "none";
    currentTab += step;
    if (currentTab >= stepTabs.length - 1) {
        sendBudget();
        return false;
    }

    showTab(currentTab);
}

function showThanks() {
    var thanks = document.getElementsByClassName("thanks")[0];
    var next = document.getElementById("nextBtn");
    var previous = document.getElementById("prevBtn");
    var step = document.getElementById("step");

    step.style.display = "none";
    next.style.display = "none";
    previous.style.display = "none";
    thanks.style.display = "block";
    thanks.style.zIndex = '99999';

}

function setStepIndicator(stepIndicator) {
    var i, step = document.getElementsByClassName("step");
    for (i = 0; i < step.length; i++) {
        step[i].className = step[i].className.replace(" active", "");
    }
    step[stepIndicator].className += " active";
}

function findCep() {
    var b = document.getElementById('budgetZipCode').value;
    var cepError = document.getElementById('cep-error');
    if (isNaN(b)) {

    }
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState == 4 && x.status == 200) {
            cepError.style.display = 'none';
            var cep = JSON.parse(this.responseText);
            if (cep.erro == true) {
                cepError.style.display = 'inline';
            } else {
                document.getElementById('budgetCity').value = cep.localidade;
                setCity(cep);
            }
        }
    }
    if (b.length == 8) {
        var rightCep = b.substring(0, 5) + '-' + b.substring(5, 8);
        budget.zipCode = rightCep;
        x.open('get', `https://viacep.com.br/ws/${rightCep}/json/`);
        x.send();
    }
}

function setCity(cep){
    budget.city = cep.localidade;
    budget.neighborhood = cep.bairro;
    budget.state = cep.uf;
}

function addCategory(id) {
    budget.budgetCategory.id = id;
    budget.budgetSubCategory.id = 79;
    eablenderBudgetNavigate(1);
}

function setPropertyType(property_type) {
    budget.meta.questions.property_type = property_type;
    if (budget.meta.questions.start)
        eablenderBudgetNavigate(1);
}

function setStart(start) {
    budget.meta.questions.start = start;
    if (budget.meta.questions.property_type)
        eablenderBudgetNavigate(1);
}

function setBudgetTitle(bt) {
    budget.title = bt;
}

function setDescription(d) {
    budget.description = d;
}

function setName(n) {
    budget.meta.userApp.name = n;
    budget.userApp.name = n;
}

function setEmail(e) {
    budget.meta.userApp.email = e;
    budget.userApp.email = e;
}

function setPhone(p) {
    p = p.replace(/[^\d]+/g, '');
    budget.meta.userApp.phone = p;
    budget.userApp.phone = p;
}

function setNeighborhood(n) {
    budget.neighborhood = n;
}

function setPersonType(pt) {
    budget.meta.questions.person_type = pt;
}

function setContactHour(ch) {
    budget.meta.questions.contact_hour = ch;
}

function setEstimatedPrice(ep) {
    budget.estimatedPrice = ep;
}

function setInterest(interest) {
    budget.meta.interest = interest;
}