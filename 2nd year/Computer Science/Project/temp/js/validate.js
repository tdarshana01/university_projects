    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var address = document.getElementById("address").value;
        var gender = document.querySelector('input[name="gender"]:checked');
        var phone = document.getElementById("phone").value;
        var nic = document.getElementById("nic").value;
        var email = document.getElementById("email").value;
        var dob = document.getElementById("dob").value;
        var nameError = document.getElementById("nameError");
        var passwordError = document.getElementById("passwordError");
        var addressError = document.getElementById("addressError");
        var genderError = document.getElementById("genderError");
        var phoneError = document.getElementById("phoneError");
        var nicError = document.getElementById("nicError");
        var emailError = document.getElementById("emailError");
        var dobError = document.getElementById("dobError");

        // Reset error messages
        nameError.innerHTML = "";
        passwordError.innerHTML = "";
        addressError.innerHTML = "";
        genderError.innerHTML = "";
        phoneError.innerHTML = "";
        nicError.innerHTML = "";
        emailError.innerHTML = "";
        dobError.innerHTML = "";

        var isValid = true;

        // Validate Name
        if (username.trim() === "") {
            nameError.innerHTML = "Please enter your name.";
            isValid = false;
        }

        // Validate Password 
        if (password.trim() === "") {
            passwordError.innerHTML = "Please enter your password.";
            isValid = false;
        }

        // Validate Address
        if (address.trim() === "") {
            addressError.innerHTML = "Please enter your address.";
            isValid = false;
        }

        // Validate Gender
        if (gender === null) {
            genderError.innerHTML = "Please select your gender.";
            isValid = false;
        }

        // Validate Phone
       if (phone.trim() === "" || isNaN(phone)) {
            phoneError.innerHTML = "Please enter a valid phone number.";
            isValid = false;
        
        }

        // Validate NIC 
        if (nic.trim() === "") {
            nicError.innerHTML = "Please enter your NIC number.";
            isValid = false;
        }
        // Validate email
        if (!isValidEmail(email)) {
            emailError.innerHTML = "Please enter a valid email address.";
            isValid = false;
        }
        // Validate dob
        if (dob.trim() === "") {
            dobError.innerHTML = "Please enter your date of birth.";
            isValid = false;
        }

        return isValid;
    }
    function isValidEmail(email) {
        // Email validation regular expression
        var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
        return emailRegex.test(email);
    }