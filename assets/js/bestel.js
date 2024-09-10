dateCheck = false;
timeCheck = false;
normalTickets = 0;
childTickets = 0;
seniorTickets = 0;
allTickets = 0;
totalPrice = 0;
discount = false;
date = "";
time = "";
lastNameCheck = false;
emailCheck = false;
emailOne = "";
emailTwo = "";
paymentCheck = false;
biosBon = false;
maestro = false;
ideal = false;
termsCheck = false;

document.getElementById('datum').addEventListener('change', function() {
    if(this.value !== "start"){
        dateCheck = true;
        date = this.value;
    } else {
        dateCheck = false;
    }
    stepCheck();
    whenUpdate();
});

document.getElementById('tijd').addEventListener('change', function() {
    if(this.value !== "start"){
        timeCheck = true;
        time = this.value;
    } else {
        timeCheck = false;
    }
    stepCheck();
    whenUpdate();
});

function stepCheck() {
    if(dateCheck && timeCheck){
        document.getElementById("stappen").style.display = "block";
        document.getElementById("filminfo").style.display = "block";
        document.getElementById("bestelbutton").style.display = "block";
        document.getElementById("datumtijd").style.marginBottom = "0";
    }
}

function whenUpdate() {
    if(dateCheck && timeCheck){
        document.getElementById("when").innerHTML = date + " om " + time;
    }
}

document.getElementById('normalTickets').addEventListener('change', function() {
    normalTickets = this.value;
    updates();
});

document.getElementById('childTickets').addEventListener('change', function() {
    childTickets = this.value;
    updates();
});

document.getElementById('seniorTickets').addEventListener('change', function() {
    seniorTickets = this.value;
    updates();
});

function updates() {
    updateTickets();
    updatePrice();
}

function updateTickets() {
    alleTickets = document.getElementById("alletickets");
    if (normalTickets > 0 && childTickets > 0 && seniorTickets > 0) {
        alleTickets.innerHTML = normalTickets + "x normaal, " + childTickets + "x kind en " + seniorTickets + "x senior";
    } else if (normalTickets > 0 && childTickets > 0) {
        alleTickets.innerHTML = normalTickets + "x normaal en " + childTickets + "x kind";
    } else if (normalTickets > 0 && seniorTickets > 0) {
        alleTickets.innerHTML = normalTickets + "x normaal en " + seniorTickets + "x senior";
    } else if (childTickets > 0 && seniorTickets > 0) {
        alleTickets.innerHTML = childTickets + "x kind en " + seniorTickets + "x senior";
    } else if (normalTickets > 0) {
        alleTickets.innerHTML = normalTickets + "x normaal";
    } else if (childTickets > 0) {
        alleTickets.innerHTML = childTickets + "x kind";
    } else if (seniorTickets > 0) {
        alleTickets.innerHTML = seniorTickets + "x senior";
    }
}

function updatePrice() {
    allTickets = parseInt(normalTickets) + parseInt(childTickets) + parseInt(seniorTickets);
    document.getElementById("totaltickets").innerHTML = allTickets;
    totalPrice = (normalTickets * 9) + (childTickets * 5) + (seniorTickets * 7);
    if(discount){
        totalPrice -= 2;
    }
    document.getElementById("totalprice").innerHTML = " €" + totalPrice + ",-";
}

document.getElementById("toevoegen").addEventListener('click', function() {
    var voucher = document.getElementById("vouchercode").value;
    if(voucher === "4815162342"){
        discount = true;
        console.log(voucher);
        updatePrice();
    }
});

document.getElementById("lastname").addEventListener('change', function() {
    if(this.value !== "" || this.value !== " "){
        lastNameCheck = true;
    }
});

document.getElementById("emailone").addEventListener('change', function() {
    if(this.value !== "" || this.value !== " "){
        emailOne = this.value;
        compareEmail();
    }
});

document.getElementById("emailtwo").addEventListener('change', function() {
    if(this.value !== "" || this.value !== " "){
        emailTwo = this.value;
        compareEmail();
    }
});

document.getElementById("biosbon").addEventListener('change', function() {
    if(this.checked){
        biosBon = true;
    } else {
        biosBon = false;
    }

    paymentChecker();
});

document.getElementById("maestro").addEventListener('change', function() {
    if(this.checked){
        maestro = true;
    } else {
        maestro = false;
    }
    paymentChecker();
});

document.getElementById("ideal").addEventListener('change', function() {
    if(this.checked){
        ideal = true;
    } else {
        ideal = false;
    }
    paymentChecker();
});

function paymentChecker() {
    if(biosBon && !maestro && !ideal){
        paymentCheck = true;
    } else if(!biosBon && maestro && !ideal){
        paymentCheck = true;
    } else if(!biosBon && !maestro && ideal){
        paymentCheck = true;
    } else {
        paymentCheck = false;
    }
}

function compareEmail() {
    if(emailOne == emailTwo){
        emailCheck = true;
    } else {
        emailCheck = false;
    }

    if(emailCheck){
        alert("Emails komen overeen");
    }
}

document.getElementById("terms").addEventListener('change', function() {
    if(this.checked){
        termsCheck = true;
        alert("U heeft de algemene voorwaarden geaccepteerd");
    } else {
        termsCheck = false;
    }
    checkAll();
});

function checkAll() {
    if(dateCheck && timeCheck && allTickets > 0 && lastNameCheck && emailCheck && paymentCheck && termsCheck){
        document.getElementById("topayment").disabled = false;
    } else {
        document.getElementById("topayment").disabled = true;
    }
}