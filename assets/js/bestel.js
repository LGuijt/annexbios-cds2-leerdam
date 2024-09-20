dateCheck = false;
timeCheck = false;
normalTickets = 0;
childTickets = 0;
seniorTickets = 0;
allTickets = 0;
totalPrice = 0;
discount = false;
discountPrice = 0;
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
seatCounter = 0;
rowText = "";
seatText = "";
seatSelected = [];
seatCheckboxes = document.getElementsByClassName("seatsinput");

document.getElementById('o-date').addEventListener('change', function() {
    if(this.value !== "start"){
        dateCheck = true;
        date = this.value;
    } else {
        dateCheck = false;
    }
    stepCheck();
    whenUpdate();
});

document.getElementById('o-time').addEventListener('change', function() {
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
        document.getElementById("steps").style.display = "block";
        document.getElementById("filminfo").style.display = "block";
        document.getElementById("orderbutton").style.display = "block";
        document.getElementById("datetime").style.marginBottom = "0";
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
    allTickets = document.getElementById("alltickets");
    if (normalTickets > 0 && childTickets > 0 && seniorTickets > 0) {
        allTickets.innerHTML = normalTickets + "x normaal, " + childTickets + "x kind en " + seniorTickets + "x senior";
    } else if (normalTickets > 0 && childTickets > 0) {
        allTickets.innerHTML = normalTickets + "x normaal en " + childTickets + "x kind";
    } else if (normalTickets > 0 && seniorTickets > 0) {
        allTickets.innerHTML = normalTickets + "x normaal en " + seniorTickets + "x senior";
    } else if (childTickets > 0 && seniorTickets > 0) {
        allTickets.innerHTML = childTickets + "x kind en " + seniorTickets + "x senior";
    } else if (normalTickets > 0) {
        allTickets.innerHTML = normalTickets + "x normaal";
    } else if (childTickets > 0) {
        allTickets.innerHTML = childTickets + "x kind";
    } else if (seniorTickets > 0) {
        allTickets.innerHTML = seniorTickets + "x senior";
    }
}

function updatePrice() {
    allTickets = parseInt(normalTickets) + parseInt(childTickets) + parseInt(seniorTickets);
    document.getElementById("totaltickets").innerHTML = allTickets;
    totalPrice = (normalTickets * 9) + (childTickets * 5) + (seniorTickets * 7);
    if(discount){
        totalPrice = totalPrice - discountPrice;
    }
    document.getElementById("totalprice").innerHTML = " €" + totalPrice + ",-";
}

document.getElementById("addvoucher").addEventListener('click', async function() {
    var voucher = document.getElementById("vouchercode").value; 

    const res = await fetch('./api/tickets/checkvoucher.php', {
        method: 'POST',
        body: JSON.stringify({
            voucher: voucher
        })
    });

    const data = await res.json();
    console.log(data.discount);
    discountPrice = data.discount;
    discount = data.valid;
    updatePrice();
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
}

document.getElementById("terms").addEventListener('change', function() {
    if(this.checked){
        termsCheck = true;
    } else {
        termsCheck = false;
    }
    checkAll();
});

function seatChooser(number){
    
    if(document.getElementById("seat"+ number).checked){
        document.getElementById("seatimg"+ number).src = "assets/img/seatselected.png";
        allSeats = seatChecker();
        seatsText(allSeats);
        seatCounter++;
        checkAll();
    } else {
        document.getElementById("seatimg"+ number).src = "assets/img/seatfree.png";
        allSeats = seatChecker();
        seatsText(allSeats);
        seatCounter--;
        checkAll();
    }
}

function seatChecker(){
    seatSelected = [];
    for(i = 0; i < seatCheckboxes.length; i++){
        if(seatCheckboxes[i].checked){
            seatSelected.push(seatCheckboxes[i].value);
        }
    }
    return seatSelected;
}

function seatsText(array){
    rowText = "";
    for(i = 0; i < array.length; i++){
        row = rowCounter(array[i], true);
        seat = rowCounter(array[i], false);
        rowText += "Rij " + row + " stoel " + seat +", ";
    }
    document.getElementById("rows").innerHTML = rowText;
}

function checkAll() {
    if(dateCheck && timeCheck && allTickets > 0 && seatCounter == allTickets && lastNameCheck && emailCheck && paymentCheck && termsCheck){
        document.getElementById("topayment").disabled = false;
    } else {
        document.getElementById("topayment").disabled = true;
    }
}

function rowCounter(number, row){
    if (number < 9){
        if(row){
            return 1;
        } else {
            return number;
        }
    } else if (number < 17){
        if(row){
            return 2;
        } else {
            return number - 8;
        }
    } else if (number < 25){
        if(row){
            return 3;
        } else {
            return number - 16;
        }
    } else if (number < 33){
        if(row){
            return 4;
        } else {
            return number - 24;
        }
    }
}
