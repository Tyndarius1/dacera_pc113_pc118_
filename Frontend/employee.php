<script src="assets/js/security.js"></script>

    <style>
  .table-container {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    width: 100%;
    max-width: 100vw;
    overflow-x: auto;
}

.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.table {
    width: 100%;
    min-width: 100%;
    table-layout: auto;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 10px;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.search-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 15px;
    width: 100%;
}

.search-container input {
    flex-grow: 1;
    max-width: 300px;
}

.content {
    margin-left: 280px;
    padding: 20px;
    width: calc(100% - 280px); 
    overflow-x: hidden; 
}

    </style>


<?php include "sidebar.php"?>

<div class="content">
    <div class="dashboard-header">
        <h2>Employees Overview</h2>
        <h4>Total Employees: <span id="total-employees">0</span></h4>
    </div>

   
    <div class="search-container">
        <input type="text" id="search-bar" class="form-control" placeholder="Search employees...">
    </div>

   
 



    <div class="table-container">
    <h4>Employees</h4>
    <div class="table-responsive">  
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="employee-table-body">
                <tr><td colspan="11" class="text-center">Loading...</td></tr>
            </tbody>
        </table>
        <p id="noResults" style="display: none; text-align: center; color: red; font-weight: bold;">No employees found</p>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    fetchEmployees();
    document.getElementById("search-bar").addEventListener("keyup", filterEmployees);
});

function fetchEmployees() {
    fetch(`http://localhost:8000/api/users?role=employee`, {
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    })
    .then(response => {
        if (!response.ok) throw new Error(`Failed to load employees`);
        return response.json();
    })
    .then(users => {
        const tableBody = document.getElementById("employee-table-body");
        tableBody.innerHTML = ""; 

        if (users.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="11" class="text-center">No employees found.</td></tr>`;
            document.getElementById("total-employees").textContent = "0";
            return;
        }

        document.getElementById("total-employees").textContent = users.length;

        users.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.first_name}</td>
                <td>${user.middle_name || '-'}</td>
                <td>${user.last_name}</td>
                <td>${user.course}</td>
                <td>${user.email}</td>
                <td>
                    <button class="btn btn-sm btn-primary">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error(error);
        document.getElementById("employee-table-body").innerHTML = `<tr><td colspan="11" class="text-danger text-center">Failed to load employees.</td></tr>`;
    });
}

function filterEmployees() {
    const searchValue = document.getElementById("search-bar").value.toLowerCase();
    const rows = document.querySelectorAll("#employee-table-body tr");
    let found = false;

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchValue)) {
            row.style.display = "";
            found = true;
        } else {
            row.style.display = "none";
        }
    });

    document.getElementById("noResults").style.display = found ? "none" : "block";
}
</script>


    
</script>

</body>
</html>
