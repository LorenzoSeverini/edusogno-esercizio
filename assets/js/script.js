
// // function show input field 
function togglePasswordVisibility() {
    const passwordInput = document.getElementById("passwordInput");
    const showPasswordIcon = document.getElementById("showPasswordIcon");
    const showPasswordCheckbox = document.querySelector('.show-password input[type="checkbox"]');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        showPasswordIcon.classList.remove("fa-eye");
        showPasswordIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        showPasswordIcon.classList.remove("fa-eye-slash");
        showPasswordIcon.classList.add("fa-eye");
    }

    // Update the checkbox state to reflect the password input's visibility
    showPasswordCheckbox.checked = (passwordInput.type === "text");
}