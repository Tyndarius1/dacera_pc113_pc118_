document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value.trim();
    const messageElement = document.getElementById("message");

    try {
        const res = await fetch("http://127.0.0.1:8000/api/login", {
            method: "POST",
            headers: { "Content-Type": "application/json", "Accept": "application/json" },
            body: JSON.stringify({ email, password }),
        });

        const data = await res.json();
        if (!res.ok || !data.token || !data.user) {
            throw new Error(data.message || "Invalid email or password.");
        }

        localStorage.setItem("user", JSON.stringify(data.user));
        localStorage.setItem("token", data.token);
        window.location.href = "dashboard.php";

    } catch (err) {
        messageElement.textContent = err.message || "Network error!";
        messageElement.classList.add("error-message", "fade-in");
        messageElement.style.display = "block";

        setTimeout(() => {
            messageElement.classList.remove("fade-in");
            messageElement.classList.add("fade-out");
            setTimeout(() => {
                messageElement.style.display = "none";
                messageElement.classList.remove("fade-out");
            }, 600);
        }, 3000);
    }
});
