<?php
session_start();
include("db.php");

$email = $_SESSION['email'];

// Student answers (from form)
$answers = $_POST['answers'];

$score = 0;
$total = 0;

// Get all questions
$questions = $conn->query("SELECT * FROM tests");

while($q = $questions->fetch_assoc()){

    $qid = $q['test_id'];
    $correct = $q['correct_answer'];

    $total++;

    if (isset($answers[$qid]) && $answers[$qid] == $correct) {
        $score++;
    }
}

// Save answers as JSON
$answers_json = json_encode($answers);

// Save result
$sql = "INSERT INTO test_results (student_email, score, total, answers)
VALUES ('$email', '$score', '$total', '$answers_json')";

$conn->query($sql);

// Redirect back
header("Location: ../frontend/test_result.php");exit();
?>