(function () {
    const token = localStorage.getItem("token");

    if (!token) {
        let confirmLogin = confirm("You need to log in to access the dashboard. Redirect to login page?");
        if (confirmLogin) {
            window.location.href = "index.php";
        } else {
            window.history.back();
        }
    } else {
        
        document.addEventListener('DOMContentLoaded', () => {
            document.body.style.display = "block";
        });
    }

    fetch("http://127.0.0.1:8000/api/users", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + token
        }
    })
    .then(response => {
        if (!response.ok) throw new Error("Unauthorized");
        return response.json();
    })
    .catch(error => {
        console.error("Error fetching user data:", error);
        localStorage.removeItem("token");
        alert("Session expired. Please log in again.");
        window.location.href = "index.php";
    });
})();


