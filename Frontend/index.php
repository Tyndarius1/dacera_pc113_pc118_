<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>


<div class="container" id="loginContainer">
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


<div class="modal" id="registerModal">
    <div class="modal-content">
        <span class="close" id="closeRegister">&times;</span>
        <h2>Register</h2>
        <form id="registerForm">
            <input type="text" id="registerName" placeholder="Full Name" required>
            <input type="email" id="registerEmail" placeholder="Email" required>

            <div class="password-container">
                <input type="password" id="registerPassword" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword('registerPassword')">👁</span>
            </div>

            <div class="password-container">
                <input type="password" id="registerPasswordConfirm" placeholder="Confirm Password" required>
                <span class="toggle-password" onclick="togglePassword('registerPasswordConfirm')">👁</span>
            </div>

            <button type="submit">Register</button>
        </form>
        <p id="registerMessage"></p>
    </div>
</div>

<script src="assets/js/login.js"></script>
<script src="assets/js/register.js"></script>
<script src="assets/js/design.js"></script>

</body>
</html>
