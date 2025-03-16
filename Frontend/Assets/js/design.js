function togglePassword(inputId) {
    let passwordField = document.getElementById(inputId);
    passwordField.type = passwordField.type === "password" ? "text" : "password";
}