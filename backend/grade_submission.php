<?php
include("db.php");
include("gemini_api.php");

$submission_id = $_POST['submission_id'];
$grade = $_POST['grade'];
$feedback = $_POST['feedback'];

// 🔥 If lecturer leaves feedback empty → AI generates it
if (empty($feedback)) {

    // Get submission file path
    $result = $conn->query("SELECT file_path FROM submissions WHERE submission_id = $submission_id");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $filePath = "../uploads/" . $row['file_path'];

        // 🔥 OPTION 1 (FAST & SAFE - recommended)
        $submission_text = "Student submitted an assignment file. Provide short constructive academic feedback.";

        /*
        // 🔥 OPTION 2 (READ FILE - slower, optional)
        if (file_exists($filePath)) {
            $submission_text = file_get_contents($filePath);
        } else {
            $submission_text = "Student submission file not found.";
        }
        */

        // 🔥 Generate AI feedback (with fallback inside)
        $feedback = generateFeedback($submission_text);

    } else {
        $feedback = "Submission not found.";
    }
}

// 🔥 Prevent SQL issues
$feedback = $conn->real_escape_string($feedback);

// Update database
$sql = "UPDATE submissions 
        SET grade = '$grade', feedback = '$feedback' 
        WHERE submission_id = $submission_id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../frontend/view_submissions.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>