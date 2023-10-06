// function to show password input field
function togglePasswordVisibility() {
    const passwordInputs = document.querySelectorAll(".passwordInput");
    const showPasswordIcons = document.querySelectorAll(".showPasswordIcon");
    
    // Loop through all password input fields and icons
    passwordInputs.forEach((passwordInput, index) => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showPasswordIcons[index].classList.remove("fa-eye");
            showPasswordIcons[index].classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            showPasswordIcons[index].classList.remove("fa-eye-slash");
            showPasswordIcons[index].classList.add("fa-eye");
        }
    });
}