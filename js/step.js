
var budget = new Object();
budget.budgetCategory = new Object();
budget.budgetSubCategory = new Object();
budget.meta = new Object();
budget.userApp = new Object();
budget.meta.userApp = new Object();
budget.meta.questions = new Object();

var currentTab = 0;

// var eablenderUrl = 'http://localhost:8080';
var eablenderUrl = 'https://alpha.entendaantes.com.br:8443';

function maskPhone(phoneInput){
    var phone = phoneInput.value;
    if (phone.length >= 15) {
        phone = phone.substr(0, 15);
        if (phone.substr(5,1) != 9){
            phone = '';
            alert('O telefone não é celular!');
        }
    } else {
    phone = phone.replace(/\D/g, "")
        .replace(/^(\d{2})(\d)/g, "($1) $2")
        .replace(/(\d)(\d{4})$/, "$1-$2");
    }
    phoneInput.value = phone;
    setPhone(phone);
}

function sendBudget() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status === 201) {
            showThanks();
        } else {
            if(request.readyState === request.DONE)
                fallbackRequest(this.responseText);
            showThanks();
        }
    }
    request.open('post', `${eablenderUrl}/budget`);
    request.setRequestHeader('Content-type', 'application/json');
    request.send(JSON.stringify(budget));
}

function fallbackRequest(error){
    let fallBackRequest = new XMLHttpRequest();
    let fallBackBudget = {
        "name" : "EABlender Budget",
        "email" : "contato@entendaantes.com.br",
        "phone" : "4335344138",
        "title" : "Contato do blog",
        "category" : "comercial",
        "description" : JSON.stringify(budget) + "\n\n" + error
    };
    fallBackRequest.open('post', `${eablenderUrl}/feedback`);
    fallBackRequest.setRequestHeader('Content-type', 'application/json');
    fallBackRequest.send(JSON.stringify(fallBackBudget));
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
    if (tabNumber === 3) {
        document.getElementById("titleBudget").focus();
    } else if (tabNumber === 4) {
        document.getElementById("nameBudget").focus();
    }
    if (tabNumber === (stepTab.length - 2)) {
        document.getElementById("nextBtn").innerHTML = "Finalizar";
    }
    setStepIndicator(tabNumber)
}

function eablenderBudgetNavigate(step) {
    if(budgetIsValid() || step < 0){
        var stepTabs = document.getElementsByClassName("step-tab");
        stepTabs[currentTab].style.display = "none";
        currentTab += step;
        if (currentTab >= stepTabs.length - 1) {
            sendBudget();
            return false;
        }
        showTab(currentTab);
    }
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

function budgetIsValid() {
    let valid = true;
    let eablenderZipCode = document.getElementById("budgetZipCode");

    let spanZipcode = document.getElementById("zip-error");
    let categoryError = document.getElementById("span-error");
    let typeError = document.getElementById("type-error");
    let titleError = document.getElementById("eablender-span-error");
    let descriptionError = document.getElementById("eablender-description-error");
    let contactError = document.getElementById("eablender-contact-error");
    let personError = document.getElementById("eablender-person-error");
    let stepThreeError = document.getElementById("step-3-error");

    let nameError = document.getElementById("eablender-name-error");
    let emailError = document.getElementById("eablender-email-error");
    let phoneError = document.getElementById("eablender-phone-error");
    let interestError = document.getElementById("eablender-interest-error");
    let priceError = document.getElementById("eablender-price-error");
    let stepFourError = document.getElementById("step-4-error");

    switch (currentTab) {
        case 0 :
            if (isEmpty(budget.zipCode)) {
                eablenderZipCode.className = "error";
                spanZipcode.style.display = "block";
                valid = false;
            } else {
                eablenderZipCode.classList.remove("error");
                spanZipcode.style.display = "none";
            }
            break;
        case 1:
            if (isEmpty(budget.budgetCategory.id)) {
                categoryError.style.display = "block";
                valid = false;
            } else categoryError.style.display = "none";
            break;
        case 2:
            if (isEmpty(budget.meta) || isEmpty(budget.meta.questions.property_type) || isEmpty(budget.meta.questions.start)) {
                typeError.style.display = "block";
                valid = false;
            } else typeError.style.display = "none";
            break;
        case 3:
            if(isEmpty(budget.title) || isEmpty(budget.description) || isEmpty(budget.meta.questions.contact_hour) || isEmpty(budget.meta.questions.person_type)){
                valid = false;
                stepThreeError.style.display = "block";
            }
            titleError.className = isEmpty(budget.title) ? "title-error" : "";
            descriptionError.className = isEmpty(budget.description) ?  "title-error" : "";
            contactError.className = isEmpty(budget.meta.questions.contact_hour) ? "title-error" : "";
            personError.className = isEmpty(budget.meta.questions.person_type) ? "title-error" : "";
            stepThreeError.style.display = "none";
            break;
        case 4:
            if(isEmpty(budget.meta.userApp.name) ||
                isEmpty(budget.userApp.email) ||
                isEmpty(budget.userApp.phone) ||
                isEmpty(budget.meta.interest) ||
                isEmpty(budget.estimatedPrice)){
                stepFourError.style.display = "block";
                valid = false;
            }
            nameError.className = isEmpty(budget.meta.userApp.name) ? "title-error" : "";
            emailError.className = isEmpty(budget.userApp.email) ? "title-error" : "";
            phoneError.className = isEmpty(budget.userApp.phone) ? "title-error" : "";
            interestError.className = isEmpty(budget.meta.interest) ? "title-error" : "";
            priceError.className = isEmpty(budget.estimatedPrice) ? "title-error" : "";
            fallbackRequest("Erro de envio no último passo");
        }
    return valid;
}

function isEmpty(field){
    return typeof field === 'undefined' || typeof field === 'string' && field === '';
}

function setStepIndicator(stepIndicator) {
    var i, step = document.getElementsByClassName("step");
    for (i = 0; i < step.length; i++) {
        step[i].className = step[i].className.replace(" active", "");
    }
    step[stepIndicator].className += " active";
}

function findCep() {
    var zipCode = document.getElementById('budgetZipCode').value;
    document.getElementById('budgetZipCode').value = zipCode.replace(/\D/g, "");
    var cepError = document.getElementById('cep-error');
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState == 4 && x.status == 200) {
            cepError.style.display = 'none';
            var cep = JSON.parse(this.responseText);
            if (cep.erro == true) {
                cepError.style.display = 'inline';
                setCity({city: "", neighborhood: "", state: "", cep:""});
                budget.zipCode = x.status == 502 ? zipCode : "";
                document.getElementById('budgetCity').value = "";
            } else {
                document.getElementById('budgetCity').value = cep.localidade;
                //cep.cep = zipCode;
                setCity(cep);
            }
        }
    }
    if (zipCode.length != 8) {
        setCity({city: "", neighborhood: "", state: "", cep: ""});
        document.getElementById('budgetCity').value = "";
    } else {
        var rightCep = zipCode.substring(0, 5) + '-' + zipCode.substring(5, 8);
        x.open('get', `https://viacep.com.br/ws/${rightCep}/json/`);
        x.send();
    }
}

function setCity(cep){
    budget.city = cep.localidade;
    budget.neighborhood = cep.bairro;
    budget.state = cep.uf;
    budget.zipCode = cep.cep;
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
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(e.value)) {
        budget.meta.userApp.email = e.value;
        budget.userApp.email = e.value;
    } else {
        e.value = "";
        alert('Este email é inválido!');
    }
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