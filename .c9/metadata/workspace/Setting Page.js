{"filter":false,"title":"Setting Page.js","tooltip":"/Setting Page.js","undoManager":{"mark":0,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":27,"column":1},"action":"remove","lines":["","","","var pass1 = document.getElementById(\"password\");","var pass2 = document.getElementById(\"re-password\");","var message = document.getElementById(\"confirmMessage\");","var goodColor = \"#66cc66\";","var badColor = \"#ff6666\";","","","pass2.onkeyup = function () {","    ","    if (pass1.value == pass2.value) {","        //The passwords match. ","        //Set the color to the good color and inform","        //the user that they have entered the correct password ","        pass2.style.backgroundColor = goodColor;","        message.style.color = goodColor;","        message.innerHTML = \"Passwords Match!\"","    } else {","        //The passwords do not match.","        //Set the color to the bad color and","        //notify the user.","        pass2.style.backgroundColor = badColor;","        message.style.color = badColor;","        message.innerHTML = \"Passwords Do Not Match!\"","    }","}"],"id":2},{"start":{"row":0,"column":0},"end":{"row":25,"column":1},"action":"insert","lines":["","var pass1 = document.getElementById(\"password\");","var pass2 = document.getElementById(\"re-password\");","var message = document.getElementById(\"confirmMessage\");","var goodColor = \"#66cc66\";","var badColor = \"#ff6666\";","","","pass2.onkeyup = function () {","    ","    if (pass1.value == pass2.value) {","        //The passwords match. ","        //Set the color to the good color and inform","        //the user that they have entered the correct password ","        pass2.style.backgroundColor = goodColor;","        message.style.color = goodColor;","        message.innerHTML = \"Passwords Match!\"","    } else {","        //The passwords do not match.","        //Set the color to the bad color and","        //notify the user.","        pass2.style.backgroundColor = badColor;","        message.style.color = badColor;","        message.innerHTML = \"Passwords Do Not Match!\"","    }","}"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":3,"column":56},"end":{"row":3,"column":56},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1524238491417,"hash":"3deaff4dc8c17d537d9b15d422af110bf18f96b9"}