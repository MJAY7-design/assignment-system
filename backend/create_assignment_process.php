<?php
include("db.php");

$title = $_POST['title'];
$course_id = $_POST['course_id'];

$target_dir = "../uploads/";
$file_name = basename($_FILES["file"]["name"]);
$target_file = $target_dir . $file_name;

move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$sql = "INSERT INTO assignments (title, file_path, course_id)
VALUES ('$title', '$file_name', $course_id)";

if ($conn->query($sql) === TRUE) {
   header("Location: ../frontend/lecturer_dashboard.php");
exit();
} else {
    echo "Error: " . $conn->error;
}
?>