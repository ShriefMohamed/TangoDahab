function setCookie(cname, cvalue, exhourse) {
    var d = new Date();
    d.setTime(d.getTime() + (exhourse*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function decreaseQty(id) {
    var qtyInput = document.getElementById("qtyInput");
    if (qtyInput.value <= 1) {
        qtyInput.setAttribute('value', 1);
    } else {
        qtyInput.setAttribute('value', parseInt(qtyInput.value) - 1);
    }
} 

function decreaseQty2(price, id) {
    var qtyInput = document.getElementById("qtyInput" + id);
    var total_cart = document.getElementById("total_cart" + id);

    if (qtyInput.value <= 1) {
        qtyInput.setAttribute('value', 1);
    } else {
        qtyInput.setAttribute('value', parseInt(qtyInput.value) - 1);

        total_cart.innerHTML = (parseInt(qtyInput.value)) * price;
        increaseQtySession(parseInt(id), 2);
        increaseTotal();
    }
} 

function toggleShow(id) {
    var createAccount = document.getElementById('create-account');
    var item = document.getElementById(id);

    if (createAccount.checked) {
        item.className = item.className.replace(" hidden", " ");
    } else {
        item.classList.add("hidden");
    }

}

function hideSelect(id) {
    var item = document.getElementById(id);
    item.style.display = "none";
}

function adminMessages(type, message) {
    var messagesDiv = document.getElementById('admin-messages');
    
    if (type == 'success') {

        messagesDiv.innerHTML = "<div class='alert alert-success alert-dismissible fade show' role='alert'>\
                                  <span class='badge badge-pill badge-success'>Success</span> \
                                    " + message + "\
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>\
                                        <span aria-hidden='true'>&times;</span>\
                                    </button>\
                                </div>";
    } else if (type == 'error') {

        messagesDiv.innerHTML = "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show'>\
                                    <span class=badge badge-pill badge-danger'>Error</span>\
                                        " + message + "\
                                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>\
                                        <span aria-hidden='true'>&times;</span>\
                                    </button>\
                                </div>";
    }
}


function getConfirmation(message){ 
    var retVal = confirm(message); 
    if ( retVal == true ){ 
        return true; 
    } else { 
        return false; 
    } 
} 