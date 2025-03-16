function togglePassword(inputId) {
    let passwordField = document.getElementById(inputId);
    passwordField.type = passwordField.type === "password" ? "text" : "password";
}


document.addEventListener("DOMContentLoaded", () => {
    const registerModal = document.getElementById("registerModal");
    const showRegister = document.getElementById("showRegister");
    const closeRegister = document.getElementById("closeRegister");

   
    showRegister.addEventListener("click", () => {
        registerModal.style.display = "flex"; 
    });

   
    closeRegister.addEventListener("click", () => {
        registerModal.style.display = "none";
    });

   
    window.addEventListener("click", (e) => {
        if (e.target === registerModal) {
            registerModal.style.display = "none";
        }
    });
});