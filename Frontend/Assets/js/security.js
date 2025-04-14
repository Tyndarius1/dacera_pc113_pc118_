(function () {
    const token = localStorage.getItem("token");

    
    if (!token) {
        alert("You must be logged in to access the dashboard.");
        window.location.href = "index.php";
    } else {
       
        const user = JSON.parse(localStorage.getItem("user"));
        if (!user || user.role !== 'admin') {
            alert("You don't have permission to access this page.");
            window.location.href = "index.php"; 
        }
    }
})();
