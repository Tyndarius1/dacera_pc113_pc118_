document.addEventListener("DOMContentLoaded", () => {
    const registerForm = document.getElementById("registerForm");

    registerForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(registerForm);

        try {
            const response = await fetch(`http://127.0.0.1:8000/api/register`, {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                alert("Registration successful!");
                
                registerForm.reset();
            } else {
                alert(`Error: ${result.message || "Registration failed."}`);
            }
        } catch (error) {
            console.error("Registration error:", error);
            alert("An error occurred while registering. Please try again.");
        }
    });
});
