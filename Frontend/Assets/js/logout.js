document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById("logout").addEventListener("click", function (event) {
        event.preventDefault();

        
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, log me out',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (!result.isConfirmed) return;

            const token = localStorage.getItem("token"); 

            if (!token) {
              
                Swal.fire({
                    title: 'Already Logged Out',
                    text: 'You are already logged out.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                }).then(() => {
                    window.location.href = "index.php"; 
                });
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
              
                Swal.fire({
                    title: 'Logged Out!',
                    text: 'You have successfully logged out.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then(() => {
                    localStorage.removeItem("token"); 
                    window.location.href = "index.php"; 
                });
            })
            .catch(error => {
                console.error("Logout error:", error);
               
                Swal.fire({
                    title: 'Error!',
                    text: 'Error logging out. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            });
        });
    });
});
