<?php
session_start();
include("../backend/db.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Get latest result
$result = $conn->query("
SELECT * FROM test_results 
WHERE student_email='$email'
ORDER BY result_id DESC
LIMIT 1
");

$data = $result->fetch_assoc();

$score = $data['score'];
$total = $data['total'];

$answers = json_decode($data['answers'], true);
?>

<!DOCTYPE html>
<html>
<head>
<title>Test Result</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
body {
    background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)),
    url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b') no-repeat center/cover;
    color: white;
}

/* Container */
.container {
    max-width: 900px;
    margin: 50px auto;
}

/* Score box */
.score-box {
    text-align: center;
    padding: 25px;
    margin-bottom: 30px;
    background: rgba(255,255,255,0.1);
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.score-box h2 {
    font-size: 32px;
}

.score-box span {
    font-size: 20px;
    color: #93c5fd;
}

/* Cards */
.card {
    background: rgba(255,255,255,0.1);
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.card b {
    font-size: 18px;
}

/* Answer styles */
.correct {
    color: #4ade80;
    font-weight: bold;
}

.wrong {
    color: #f87171;
    font-weight: bold;
}

/* Answer labels */
.answer-box {
    margin-top: 10px;
}
</style>
</head>

<body>

<div class="container">

<!-- SCORE -->
<div class="score-box">
    <h2>Your Score: <?php echo "$score / $total"; ?></h2>
    <span><?php echo round(($score/$total)*100); ?>%</span>
</div>

<?php
$questions = $conn->query("SELECT * FROM tests");

while($q = $questions->fetch_assoc()) {

    $qid = $q['test_id'];
    $student = $answers[$qid] ?? "Not answered";
    $correct = $q['correct_answer'];

    echo "<div class='card'>";

    echo "<b>".$q['question']."</b><br>";

    echo "<div class='answer-box'>Your Answer: $student</div>";
    echo "<div class='answer-box'>Correct Answer: $correct</div>";

    if ($student == $correct) {
        echo "<div class='correct'>✔ Correct</div>";
    } else {
        echo "<div class='wrong'>✘ Wrong</div>";
    }

    echo "</div>";
}
?>

</div>

</body>
</html>