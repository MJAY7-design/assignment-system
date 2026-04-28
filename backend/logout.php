<?php
session_start();

// clear session
$_SESSION = [];
session_unset();
session_destroy();

// redirect to login
header("Location: ../frontend/login.php");
exit();