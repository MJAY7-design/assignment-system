<?php
session_start();

// 🔥 PROTECT PAGE + FIX WRONG EMAIL ISSUE
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

include("../backend/db.php");

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>LMS</h2>

    <a href="student_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="student_profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="enroll_course.php"><i class="fas fa-plus-circle"></i> Enroll Course</a>
    <a href="take_test.php"><i class="fas fa-edit"></i> Take Test</a>
    <a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="topbar" style="display:flex; justify-content:space-between; align-items:center;">
    <h2>Welcome Student</h2>

    <div style="display:flex; align-items:center; gap:15px;">
       

        <div style="display:flex; align-items:center; gap:10px;">
            <i class="fas fa-user-circle"></i>
            <span><?php echo $email; ?></span>
        </div>
    </div>
</div>

<!-- ASSIGNMENTS -->
<h2>Assignments</h2>

<?php
$sql = "SELECT assignments.assignment_id, assignments.title, assignments.file_path, 
courses.course_name, submissions.grade, submissions.feedback
FROM assignments 
JOIN courses ON assignments.course_id = courses.course_id
JOIN enrollments ON enrollments.course_id = courses.course_id
LEFT JOIN submissions 
ON submissions.submission_id = (
    SELECT MAX(s2.submission_id)
    FROM submissions s2
    WHERE s2.assignment_id = assignments.assignment_id
    AND s2.student_email = '$email'
)
WHERE enrollments.student_email = '$email'";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        echo "<div class='card'>";
        echo "<b>Course:</b> ".$row['course_name']."<br>";
        echo "<b>Assignment:</b> ".$row['title']."<br><br>";

        echo "<a href='../uploads/".$row['file_path']."' download>Download</a><br><br>";

        echo "<form action='../backend/submit_assignment_process.php' method='POST' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='assignment_id' value='".$row['assignment_id']."'>";
        echo "<input type='file' name='submission_file' required>";
        echo "<input type='submit' value='Submit Assignment'>";
        echo "</form>";

        if ($row['grade'] !== null) {
            echo "<br><b>Grade:</b> ".$row['grade']."<br>";
            echo "<b>Feedback:</b> ".$row['feedback']."<br>";
        }

        echo "</div>";
    }
} else {
    echo "<div class='card'>No assignments available yet.</div>";
}
?>

<!-- SLIDES -->
<h2 style="margin-top:30px;">Lecture Slides</h2>

<div style="max-width:900px; margin:auto;">

<?php
$slides = $conn->query("SELECT slides.*, courses.course_name 
FROM slides 
JOIN courses ON slides.course_id = courses.course_id");

if ($slides && $slides->num_rows > 0) {
    while($row = $slides->fetch_assoc()) {

        echo "<div class='card' style='margin-bottom:15px;'>";

        echo "<b>Course:</b> ".$row['course_name']."<br>";
        echo "<b>Slide:</b> ".$row['title']."<br><br>";

        echo "<a href='../uploads/".$row['file_path']."' download 
        style='display:inline-block; padding:10px 15px; background:#2563eb; color:white; border-radius:6px; text-decoration:none;'>
        Download Slide
        </a>";

        echo "</div>";
    }
} else {
    echo "<div class='card' style='text-align:center;'>No slides uploaded yet.</div>";
}
?>

</div>

</div>


</body>
</html>