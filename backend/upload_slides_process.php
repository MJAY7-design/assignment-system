<?php
include("db.php");

$title = $_POST['title'];
$course_id = $_POST['course_id'];

$file_name = $_FILES['file']['name'];
$target = "../uploads/" . $file_name;

if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

    $sql = "INSERT INTO slides (title, file_path, course_id)
            VALUES ('$title', '$file_name', '$course_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Slide uploaded successfully <br>";
        echo "<a href='http://localhost/assignment-system/frontend/upload_slides.php'>Go Back</a>";
    } else {
        echo "Database error: " . $conn->error;
    }

} else {
    echo "File upload failed";
}
?>