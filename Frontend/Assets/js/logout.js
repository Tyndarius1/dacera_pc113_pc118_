document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById("logout").addEventListener("click", function (event) {
        event.preventDefault();

        let confirmLogout = confirm("Are you sure you want to log out?");
        if (!confirmLogout) return; 

        const token = localStorage.getItem("token"); 

        if (!token) {
            alert("You are already logged out.");
            window.location.href = "index.php";
            return;
        }

        
        fetch("http://127.0.0.1:8000/api/logout", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Logout failed");
            }
            return response.json();
        })
        .then(data => {
            alert("Logout successful!");
            localStorage.removeItem("token"); 
            window.location.href = "index.php";
        })
        .catch(error => {
            console.error("Logout error:", error);
            alert("Error logging out. Try again.");
        });
    });
});