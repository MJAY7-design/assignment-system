<?php
session_start();
include("db.php");

$course_id = $_POST['course_id'];
$student_email = $_SESSION['email'];

$sql = "INSERT INTO enrollments (student_email, course_id)
VALUES ('$student_email', $course_id)";

if ($conn->query($sql) === TRUE) {
    echo "Enrolled successfully <br>";
    echo "<a href='../frontend/student_dashboard.php'>Go Back</a>";
} else {
    echo "Error: " . $conn->error;
}
?>