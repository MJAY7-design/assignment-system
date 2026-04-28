<?php
session_start();
session_unset();   // clear old session
session_destroy(); // destroy old session
session_start();

include("db.php");

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// STUDENT LOGIN
if ($role == "student") {

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='student'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = "student";

        header("Location: ../frontend/student_dashboard.php");
        exit();
    } else {
        echo "Invalid student login";
    }
}

// LECTURER LOGIN
if ($role == "lecturer") {

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='lecturer'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = "lecturer";

        header("Location: ../frontend/lecturer_dashboard.php");
        exit();
    } else {
        echo "Invalid lecturer login";
    }
}
?>