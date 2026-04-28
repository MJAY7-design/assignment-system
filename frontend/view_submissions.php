<?php
session_start();
include("../backend/db.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT submissions.*, assignments.title 
FROM submissions 
JOIN assignments ON submissions.assignment_id = assignments.assignment_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Submissions</title>
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
    <h2>Student Submissions</h2>
</div>

<?php
if ($result && $result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        echo "<div class='card'>";
        echo "<h3>".$row['title']."</h3>";
        echo "<p><b>Student:</b> ".$row['student_email']."</p>";

        echo "<a href='../uploads/".$row['file_path']."' download>Download</a><br><br>";

        if ($row['grade']) {
            echo "<p><b>Grade:</b> ".$row['grade']."</p>";
            echo "<p><b>Feedback:</b> ".$row['feedback']."</p>";
        }

        echo "<form action='../backend/grade_submission.php' method='POST'>";
        echo "<input type='hidden' name='submission_id' value='".$row['submission_id']."'>";
        echo "<input type='number' name='grade' placeholder='Enter grade' required>";
        echo "<textarea name='feedback' placeholder='Enter feedback (leave empty for AI)'></textarea>";
        echo "<input type='submit' value='Submit Grade'>";
        echo "</form>";

        echo "</div>";
    }

} else {
    echo "<div class='card'>No submissions yet.</div>";
}
?>

</div>

</body>
</html>