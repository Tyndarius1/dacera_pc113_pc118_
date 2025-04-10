<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS (requires jQuery) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>

body {
display: flex;
min-height: 100vh;
background: #f5f7fa;
color: #343a40;
font-family: 'Poppins', sans-serif;
margin: 0; 
}
.sidebar {
width: 260px;
background: #ffffff;
padding: 20px;
height: 100vh;
box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
position: fixed;
transition: all 0.3s;
}
.sidebar h4 {
text-align: center;
color: #007bff;
font-weight: bold;
margin-bottom: 20px;
}
.sidebar a {
color: #343a40;
text-decoration: none;
display: flex;
align-items: center;
padding: 12px;
margin: 5px 0;
border-radius: 5px;
transition: all 0.3s;
position: relative;
font-size: 16px;
}
.sidebar a i {
margin-right: 10px;
}
.sidebar a:hover, .sidebar .active {
background: #007bff;
color: white;
}
.dropdown-menu {
display: none;
flex-direction: column;
padding-left: 20px;
}
.dropdown.active .dropdown-menu {
display: flex;
}
.content {
flex: 1; 
padding: 20px;
margin-left: 260px; 
width: calc(100% - 260px); 
}
.dashboard-header {
display: flex;
justify-content: space-between;
align-items: center;
background: white;
padding: 15px 25px;
border-radius: 10px;
box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
margin-bottom: 20px;
}
</style>  

<script>
document.addEventListener("DOMContentLoaded", function() {
document.querySelector(".dropdown-toggle").addEventListener("click", function(event) {
event.preventDefault();
this.parentElement.classList.toggle("active");
});
});
</script>


</head>
<body></body>
<div class="sidebar">
<h4>API <br> Integration </h4>
<a href="/dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>


<div class="dropdown">
<a href="#" class="dropdown-toggle d-flex align-items-center">
<i class="fas fa-users"></i> <span>Users</span>
</a>
<div class="dropdown-menu">
<a href="/employee.php"><i class="fas fa-user-tie"></i> Employee</a>
<a href="/student.php"><i class="fas fa-user-graduate"></i> Student</a>
</div>

</div>
<a href="#"><i class="fas fa-user"></i> Profile</a>
<a href="#" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<script src="assets/js/logout.js"></script>
