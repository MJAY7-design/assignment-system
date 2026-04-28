<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>LMS Login</title>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

/* BACKGROUND */
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;

    background: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b') no-repeat center center/cover;

    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* 🔥 OPTIONAL OVERLAY (like dashboard feel) */
body::before {
    content: "";
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.6); /* soft dark overlay */
    top: 0;
    left: 0;
    z-index: -1;
}

/* 🔥 FIXED CLASS NAME */
.login-card {
    width: 350px;
    padding: 30px;
    border-radius: 15px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    text-align: center;
    color: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* TITLE */
.login-card h2 {
    font-size: 26px;
    margin-bottom: 10px;
    color: white;
}

/* SUBTEXT */
.login-card p {
    font-size: 14px;
    margin-bottom: 20px;
    color: #cbd5f5;
}

/* INPUTS */
.login-card input,
.login-card select {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.2);
    color: white;
}

/* PLACEHOLDER */
.login-card input::placeholder {
    color: #e5e7eb;
}

/* PASSWORD ICON */
.password-wrapper {
    position: relative;
}

.password-wrapper i {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #e5e7eb;
}

/* 🔥 FIX BUTTON */
.login-card input[type="submit"] {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(90deg, #3b82f6, #6366f1);
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.login-card input[type="submit"]:hover {
    transform: scale(1.05);
}

/* SELECT FIX */
.login-card select {
    color: black;
}

</style>

</head>

<body>

<div class="login-card">

    <h2>LMS System</h2>
    <p>Welcome back! Please login to continue</p>

    <form action="../backend/login_process.php" method="POST">

        <input type="email" name="email" placeholder="Enter Email" required>

        <div class="password-wrapper">
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <i class="fas fa-eye" onclick="togglePassword()"></i>
        </div>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select>

        <input type="submit" value="Login">

    </form>

</div>

<script>
function togglePassword() {
    var pass = document.getElementById("password");

    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

</body>
</html>