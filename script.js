function validateSignup() {
    let password = document.getElementById("password").value;
    upper = false;
    num = false;
    // loops for the password checking if the letter is an uppercase or a number
    for (let i = 0; i < password.length; i++) {
        letter = password.charAt(i);
        if (letter == letter.toUpperCase()) {
            upper = true;
        }
        if (isNaN(letter) == false){ 
            num = true;
        }

    }
    // checks for both flags
    if ((upper) && (num)) { 
        return true;
    } else {
        // error message
        document.getElementById("error").innerHTML = "Password must have an uppercase character and a number";
        return false;
    }
}