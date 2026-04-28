<?php
$conn = new mysqli("localhost", "root", "", "assignment_system", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>