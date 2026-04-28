<?php
session_start();
include("../backend/db.php");

// 🔥 PROTECT PAGE (VERY IMPORTANT)
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// You can later fetch this from DB if needed
$name = "Student";
$student_id = "PUIS/23210011";

/* 🔥 GET ALL GRADED SUBMISSIONS */
$sql = "
SELECT submissions.grade, assignments.title, courses.course_name
FROM submissions
JOIN assignments ON submissions.assignment_id = assignments.assignment_id
JOIN courses ON assignments.course_id = courses.course_id
WHERE submissions.student_email='$email' AND submissions.grade IS NOT NULL
";

$result = $conn->query($sql);

$total_points = 0;
$count = 0;
$rows = [];

if ($result && $result->num_rows > 0) {

    while($r = $result->fetch_assoc()){

        $score = $r['grade'];

        // 🎯 GPA SCALE
        if ($score >= 80) $points = 4;
        elseif ($score >= 70) $points = 3;
        elseif ($score >= 60) $points = 2;
        elseif ($score >= 50) $points = 1;
        else $points = 0;

        $r['points'] = $points;
        $rows[] = $r;

        $total_points += $points;
        $count++;
    }
}

// 🔥 FINAL GPA
$gpa = ($count > 0) ? round($total_points / $count, 2) : null;
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Profile</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
body {
    background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)),
    url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b') no-repeat center/cover;
}

.profile-container {
    max-width: 900px;
    margin: 80px auto;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    padding: 30px;
    border-radius: 15px;
    color: white;
}

.profile-icon {
    font-size: 70px;
    text-align:center;
}

.gpa-box {
    text-align:center;
    margin:20px 0;
}

.gpa-value {
    font-size: 30px;
    font-weight: bold;
}

table {
    width:100%;
    border-collapse: collapse;
    margin-top:20px;
}

th, td {
    padding:10px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}
</style>
</head>

<body>

<div class="profile-container">

<div style="text-align:center;">
<i class="fas fa-user-circle profile-icon"></i>
<h2><?php echo $name; ?></h2>
<p><?php echo $email; ?></p>
<p><b>ID:</b> <?php echo $student_id; ?></p>
</div>

<!-- GPA DISPLAY -->
<div class="gpa-box">

<?php
if ($gpa !== null) {
    echo "<div class='gpa-value'>GPA: $gpa</div>";
} else {
    echo "<div class='gpa-value'>No GPA yet</div>";
}
?>

</div>

<!-- GPA BREAKDOWN -->
<h3>GPA Breakdown</h3>

<?php if (count($rows) > 0) { ?>

<table>
<tr>
<th>Course</th>
<th>Assignment</th>
<th>Score</th>
<th>Points</th>
</tr>

<?php
foreach($rows as $r){
    echo "<tr>";
    echo "<td>".$r['course_name']."</td>";
    echo "<td>".$r['title']."</td>";
    echo "<td>".$r['grade']."</td>";
    echo "<td>".$r['points']."</td>";
    echo "</tr>";
}
?>

</table>

<?php } else {
    echo "<p>No graded work yet.</p>";
} ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>

</body>
</html>