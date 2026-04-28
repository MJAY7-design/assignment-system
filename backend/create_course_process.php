<?php

session_start();
include("db.php");

$course_name = $_POST['course_name'];
$course_code = $_POST['course_code'];
$lecturer_email = $_SESSION['email'];

$sql = "INSERT INTO courses (course_name, course_code, lecturer_email)
VALUES ('$course_name','$course_code','$lecturer_email')";

$conn->query($sql);

echo "Course created successfully";
?>