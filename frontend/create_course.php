<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Course</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="sidebar">
    <h2>LMS</h2>
    <a href="lecturer_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="create_course.php"><i class="fas fa-book"></i> Create Course</a>
    <a href="create_assignment.php"><i class="fas fa-upload"></i> Create Assignment</a>
    <a href="view_submissions.php"><i class="fas fa-file-alt"></i> Submissions</a>
    <a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main">

<div class="topbar">
    <h2>Create Course</h2>
</div>

<div class="card">

<form action="../backend/create_course_process.php" method="POST">

<input type="text" name="course_name" placeholder="Course Name" required>
<input type="text" name="course_code" placeholder="Course Code" required>

<input type="submit" value="Create Course">

</form>

</div>

</div>

</body>
</html>