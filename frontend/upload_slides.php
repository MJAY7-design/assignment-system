<?php
session_start();
include("../backend/db.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Slides</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="sidebar">
    <h2>LMS</h2>
    <a href="lecturer_dashboard.php">Dashboard</a>
    <a href="upload_slides.php">Upload Slides</a>
    <a href="../backend/logout.php">Logout</a>
</div>

<div class="main">

<div class="topbar">
    <h2>Upload Lecture Slides</h2>
</div>

<div class="card">

<form action="http://localhost/assignment-system/backend/upload_slides_process.php" method="POST" enctype="multipart/form-data">

<input type="text" name="title" placeholder="Slide Title" required>

<select name="course_id" required>
<option value="">Select Course</option>

<?php
$result = $conn->query("SELECT * FROM courses");
while($row = $result->fetch_assoc()){
    echo "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
}
?>

</select>

<input type="file" name="file" required>

<input type="submit" value="Upload Slide">

</form>

</div>

</div>

</body>
</html>