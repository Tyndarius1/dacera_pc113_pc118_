document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registerForm");

    registerForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const data = {
            first_name: document.getElementById("first_name").value.trim(),
            middle_name: document.getElementById("middle_name").value.trim(),
            last_name: document.getElementById("last_name").value.trim(),
            address: document.getElementById("address").value.trim(),
            contact_number: document.getElementById("contact_number").value.trim(),
            age: document.getElementById("age").value.trim(),
            gender: document.getElementById("gender").value.trim(),
            status: document.getElementById("status").value.trim(),
            email: document.getElementById("email").value.trim(),
            password: document.getElementById("password").value.trim(),
        };

        const errorMessageElement = document.getElementById("errorMessage");
        if (errorMessageElement) {
            errorMessageElement.textContent = '';
        }

        if (!data.email || !data.password || !data.first_name || !data.last_name) {
            displayErrorMessage("Please fill in all required fields.");
            return;
        }

        if (data.password.length < 3) {
            displayErrorMessage("Password must be at least 6 characters.");
            return;
        }

        fetch("http://127.0.0.1:8000/api/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then(function (response) {
            if (!response.ok) {
                return response.json().then(function (result) {
                    let errorMessage = result.message || "Registration failed. Please try again.";
                    displayErrorMessage(errorMessage);
                    throw new Error(errorMessage);
                });
            }
            return response.json();
        })
        .then(function () {
            Swal.fire({
                title: 'Success!',
                text: 'Registration successful!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                registerForm.reset();
            });
        })
        .catch(function (error) {
            console.error("Error during registration:", error);
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again later.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });

    function displayErrorMessage(message) {
        let errorMessageElement = document.getElementById("errorMessage");

        if (!errorMessageElement) {
            errorMessageElement = document.createElement("div");
            errorMessageElement.id = "errorMessage";
            errorMessageElement.style.color = "red";
            errorMessageElement.style.marginTop = "10px";
            registerForm.appendChild(errorMessageElement);
        }

        errorMessageElement.textContent = message;
    }
});
