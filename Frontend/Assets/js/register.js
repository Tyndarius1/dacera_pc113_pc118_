document.getElementById("registerForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const name = document.getElementById("registerName").value.trim();
    const email = document.getElementById("registerEmail").value.trim();
    const password = document.getElementById("registerPassword").value.trim();
    const password_confirmation = document.getElementById("registerPasswordConfirm").value.trim();
    const registerMessageElement = document.getElementById("registerMessage");

    try {
        const res = await fetch("http://127.0.0.1:8000/api/register", {
            method: "POST",
            headers: { "Content-Type": "application/json", "Accept": "application/json" },
            body: JSON.stringify({ name, email, password, password_confirmation }),
        });

        const data = await res.json();
        if (!res.ok) {
            let errorMsg = "";
            if (data.errors) {
                for (const key in data.errors) {
                    errorMsg += `${data.errors[key].join(" ")} `;
                }
            }
            throw new Error(errorMsg || "Registration failed!");
        }

        registerMessageElement.style.color = "green";
        registerMessageElement.innerText = "Registration successful! Log in now!.";
        setTimeout(() => {
            document.getElementById("registerModal").style.display = "none";
        }, 2000);
    } catch (err) {
        registerMessageElement.style.color = "red";
        registerMessageElement.innerText = err.message || "Network error!";
    }
});