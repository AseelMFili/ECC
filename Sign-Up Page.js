var email1 = document.getElementById("email");
var email2 = document.getElementById("re-email");
var messageEmail = document.getElementById("confirmEmail");

var pass1 = document.getElementById("password");
var pass2 = document.getElementById("re-password");
var message = document.getElementById("confirmMessage");
var goodColor = "#66cc66";
var badColor = "#ff6666";


pass2.onkeyup = function () {
    
    if (pass1.value == pass2.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}

email2.onkeyup = function () {
    
    if (email1.value == email2.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        email2.style.backgroundColor = goodColor;
        messageEmail.style.color = goodColor;
        messageEmail.innerHTML = "Email Match!"
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        email2.style.backgroundColor = badColor;
        messageEmail.style.color = badColor;
        messageEmail.innerHTML = "Email Does Not Match!"
    }
}

