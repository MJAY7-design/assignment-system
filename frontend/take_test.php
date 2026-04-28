<?php
session_start();
include("../backend/db.php");

// 🔒 Protect page properly
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Get questions for enrolled courses
$result = $conn->query("
SELECT tests.*, courses.course_name
FROM tests
JOIN courses ON tests.course_id = courses.course_id
JOIN enrollments ON enrollments.course_id = courses.course_id
WHERE enrollments.student_email = '$email'
ORDER BY courses.course_name
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Take Test</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
.test-container {
    max-width: 850px;
    margin: 40px auto;
}

.test-card {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.test-card p {
    font-size: 20px;
    margin-bottom: 15px;
}

.test-option {
    display: block;
    padding: 10px;
    margin: 8px 0;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.test-option:hover {
    background: rgba(255,255,255,0.2);
}

.submit-btn {
    display: block;
    margin: 20px auto;
    padding: 12px 25px;
    font-size: 16px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.submit-btn:hover {
    background: #1e40af;
}
</style>
</head>

<body>

<div class="main">

<h2 style="text-align:center;">Take Test</h2>

<div class="test-container">

<form action="../backend/take_test_process.php" method="POST">

<?php
$currentCourse = "";

if ($result && $result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        // 🔥 Group by course
        if ($currentCourse != $row['course_name']) {
            echo "<h3>".$row['course_name']."</h3>";
            $currentCourse = $row['course_name'];
        }

        echo "<div class='test-card'>";

        echo "<p><b>".$row['question']."</b></p>";

        // 🔥 IMPORTANT FIX → answers[] not answer[]
        echo "<label class='test-option'>
        <input type='radio' name='answers[".$row['test_id']."]' value='A' required>
        ".$row['option_a']."
        </label>";

        echo "<label class='test-option'>
        <input type='radio' name='answers[".$row['test_id']."]' value='B'>
        ".$row['option_b']."
        </label>";

        echo "<label class='test-option'>
        <input type='radio' name='answers[".$row['test_id']."]' value='C'>
        ".$row['option_c']."
        </label>";

        echo "<label class='test-option'>
        <input type='radio' name='answers[".$row['test_id']."]' value='D'>
        ".$row['option_d']."
        </label>";

        echo "</div>";
    }

    echo "<button class='submit-btn' type='submit'>Submit Test</button>";

} else {
    echo "<div class='test-card'>No test available for your courses.</div>";
}
?>

</form>

</div>

</div>

</body>
</html>