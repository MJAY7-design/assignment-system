<?php
session_start();
include("../backend/db.php");

$email = $_SESSION['email'];

$sql = "SELECT * FROM courses WHERE lecturer_email='$email'";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="dashboard">

<h2>My Courses</h2>

<?php

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        echo "<div class='card'>";
        echo "<b>Course Name:</b> " . $row['course_name'] . "<br>";
        echo "<b>Course Code:</b> " . $row['course_code'] . "<br>";
        echo "</div>";
    }

} else {

    echo "No courses created yet.";

}

?>

</div>