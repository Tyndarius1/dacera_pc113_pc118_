<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/register.css">



</head>
<body>

<div class="container">
    <div class="login-wrapper">
        <div class="login-form">
            <h2>Login</h2>
            <form id="loginForm">
                <input type="email" id="loginEmail" placeholder="Email" required>

                <div class="password-container">
                    <input type="password" id="loginPassword" placeholder="Password" required>
                    <span class="toggle-password" onclick="togglePassword('loginPassword')">👁</span>
                </div>

                <button type="submit">Login</button>
            </form>
            <p id="message"></p>
            <span class="toggle-link" id="showRegister">Don't have an account? Sign up</span>
        </div>

        <div class="image-section">
            <img src="assets/img/skull.jpg" alt="Image" class="login-image">
        </div>
    </div>
</div>


<div id="registerModal" class="modal">
    <div class="modal-content">
        <span id="closeRegister" class="close-button">&times;</span>
        <h2>Register</h2>
        <form id="registerForm" class="grid-form" enctype="multipart/form-data">
            <input type="text" id="first_name" placeholder="First Name" required>
            <input type="text" id="middle_name" placeholder="Middle Name" required>

            <input type="text" id="last_name" placeholder="Last Name" required>
            <input type="text" id="address" placeholder="Address" required>

            <input type="text" id="contact_number" placeholder="Contact Number" required>
            <input type="text" id="age" placeholder="Age" required>

            <input type="text" id="gender" placeholder="Gender" required>
            <input type="text" id="status" placeholder="Status" required>

            <input type="email" id="email" placeholder="Email" required>
            <input type="password" id="password" placeholder="Password" required>

            <input type="file" id="profile" name="profile">

            <div class="full-width">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</div>

<!-- <script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script> -->


<script src="assets/js/login.js"></script>
<script src="assets/js/register.js"></script>
<script src="assets/js/design.js"></script>

</body>
</html>
