<?php
session_start();
include("db.php");
include("gemini_api.php");

$answers = $_POST['answer'];
$score = 0;
$total = count($answers);

$summary = "";

// 🔥 LOOP THROUGH ANSWERS
foreach ($answers as $test_id => $answer) {

    $result = $conn->query("SELECT question, correct_answer FROM tests WHERE test_id = $test_id");
    $row = $result->fetch_assoc();

    // Mark score
    if ($answer == $row['correct_answer']) {
        $score++;
    }

    // 🔥 BUILD SUMMARY (THIS IS WHAT YOU ASKED ABOUT)
    $summary .= "Question: " . $row['question'] . "\n";
    $summary .= "Student Answer: " . $answer . "\n";
    $summary .= "Correct Answer: " . $row['correct_answer'] . "\n\n";
}

// 🔥 SEND TO GEMINI
$feedback = generateFeedback("Analyze this student's test performance and give constructive feedback:\n\n" . $summary);

// 🔥 DISPLAY RESULT
echo "<h2>Your Score: $score / $total</h2>";

echo "<h3>AI Feedback:</h3>";
echo "<p>$feedback</p>";
?>