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
<title>Create Test</title>
<link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<div class="main">

<h2>Create Test Question</h2>

<form action="../backend/create_test_process.php" method="POST">

<input type="text" name="question" placeholder="Question" required><br><br>

<input type="text" name="option_a" placeholder="Option A" required><br>
<input type="text" name="option_b" placeholder="Option B" required><br>
<input type="text" name="option_c" placeholder="Option C" required><br>
<input type="text" name="option_d" placeholder="Option D" required><br><br>

<select name="correct_answer" required>
<option value="">Correct Answer</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
</select><br><br>

<select name="course_id" required>
<option value="">Select Course</option>
<?php
$res = $conn->query("SELECT * FROM courses");
while($row = $res->fetch_assoc()){
echo "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
}
?>
</select><br><br>

<button type="submit">Create Test</button>

</form>

</div>

</body>
</html>