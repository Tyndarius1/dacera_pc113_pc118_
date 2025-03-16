<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Admin Dashboard - User List</h2>

        <!-- Search Bar -->
        <div class="mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Search users...">
        </div>

        <!-- User Table -->
        <div class="table-responsive">
            <table class="table table-hover table-striped border">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <!-- Data will be inserted here -->
                </tbody>
            </table>
        </div>
        
        <div id="error-message" class="alert alert-danger d-none"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const token = localStorage.getItem("token");
            if (!token) {
                window.location.href = "../index.php"; 
                return;
            }

            try {
                // Fetch API data with Authorization Header
                const response = await fetch("http://127.0.0.1:8000/api/users", {
                    method: "GET",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json"
                    }
                });

                if (!response.ok) {
                    throw new Error(`Error ${response.status}: ${response.statusText}`);
                }

                const data = await response.json();
                const users = data.users || data;

                const tableBody = document.getElementById("userTableBody");

                if (users.length === 0) {
                    tableBody.innerHTML = "<tr><td colspan='4' class='text-center'>No users found.</td></tr>";
                    return;
                }

                // Populate Table
                tableBody.innerHTML = users.map(user => `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role || 'N/A'}</td>
                    </tr>
                `).join("");

            } catch (err) {
                console.error("Error fetching users:", err);
                document.getElementById("error-message").innerText = "Failed to load users. Please check your API.";
                document.getElementById("error-message").classList.remove("d-none");
            }
        });

        // Search Function
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#userTableBody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
    </script>
</body>
</html>
