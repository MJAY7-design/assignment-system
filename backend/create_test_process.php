<?php
include("db.php");

$q = $_POST['question'];
$a = $_POST['option_a'];
$b = $_POST['option_b'];
$c = $_POST['option_c'];
$d = $_POST['option_d'];
$correct = $_POST['correct_answer'];
$course_id = $_POST['course_id'];

$conn->query("INSERT INTO tests 
(question, option_a, option_b, option_c, option_d, correct_answer, course_id)
VALUES ('$q','$a','$b','$c','$d','$correct','$course_id')");

echo "Test created successfully <br>";
echo "<a href='../frontend/lecturer_dashboard.php'>Go Back</a>";