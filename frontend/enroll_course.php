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
    <title>Enroll Course</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="sidebar">
    <h2>LMS</h2>
    <a href="student_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="enroll_course.php"><i class="fas fa-plus-circle"></i> Enroll Course</a>
    <a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main">

<div class="topbar">
    <h2>Enroll in Course</h2>
</div>

<div class="card">

<form action="../backend/enroll_course_process.php" method="POST">

<select name="course_id" required>
<option value="">Select Course</option>

<?php
$result = $conn->query("SELECT * FROM courses");

while($row = $result->fetch_assoc()) {
    echo "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
}
?>

</select>

<input type="submit" value="Enroll">

</form>

</div>

</div>

</body>
</html>