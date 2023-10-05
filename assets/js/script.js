
// function show password field 
function togglePasswordVisibility() {
    // Get the password input field
    const passwordInput = document.getElementsByClassName("passwordInput");
    // Get the show password icon
    const showPasswordCheckbox = document.querySelector('.show-password input[type="checkbox"]');

    // If the checkbox is checked, show the password
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        showPasswordIcon.classList.remove("fa-eye");
        showPasswordIcon.classList.add("fa-eye-slash");
    } else {
        // Otherwise, hide the password
        passwordInput.type = "password";
        showPasswordIcon.classList.remove("fa-eye-slash");
        showPasswordIcon.classList.add("fa-eye");
    }

    // Update the checkbox state to reflect the password input's visibility
    showPasswordCheckbox.checked = (passwordInput.type === "text");
}