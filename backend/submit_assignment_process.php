<?php

session_start();
include("db.php");

// Get values
$assignment_id = $_POST['assignment_id'];
$student_email = $_SESSION['email'];

// File upload
$target_dir = "../uploads/";
$file_name = basename($_FILES["submission_file"]["name"]);
$target_file = $target_dir . $file_name;

// Move file
if (move_uploaded_file($_FILES["submission_file"]["tmp_name"], $target_file)) {

    $sql = "INSERT INTO submissions (assignment_id, student_email, file_path)
            VALUES ($assignment_id, '$student_email', '$file_name')";

    if ($conn->query($sql) === TRUE) {

        echo "Assignment submitted successfully <br>";
        echo "<a href='../frontend/student_dashboard.php'>Go Back</a>";

    } else {

        echo "Database error: " . $conn->error;

    }

} else {

    echo "File upload failed";

}

?>