<?php
session_start();

// protect page
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'lecturer') {
    header("Location: login.php");
    exit();
}

include("../backend/db.php");

$email = $_SESSION['email'];

// Get lecturer name
$userQuery = $conn->query("SELECT name FROM users WHERE email='$email'");
$userData = $userQuery ? $userQuery->fetch_assoc() : null;
$lecturerName = $userData && isset($userData['name']) ? $userData['name'] : 'Mr Harry-Atieku';

// Dashboard stats
$courseCount = 0;
$assignmentCount = 0;
$submissionCount = 0;

$courseCountResult = $conn->query("SELECT COUNT(*) as total FROM courses");
if ($courseCountResult) {
    $courseCount = $courseCountResult->fetch_assoc()['total'];
}

$assignmentCountResult = $conn->query("SELECT COUNT(*) as total FROM assignments");
if ($assignmentCountResult) {
    $assignmentCount = $assignmentCountResult->fetch_assoc()['total'];
}

$submissionCountResult = $conn->query("SELECT COUNT(*) as total FROM submissions");
if ($submissionCountResult) {
    $submissionCount = $submissionCountResult->fetch_assoc()['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .course-grid {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .course-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            padding: 18px;
            border-radius: 14px;
            color: white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 70%;
        }

        .section-title {
            margin-top: 25px;
            margin-bottom: 15px;
            color: white;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>LMS</h2>

    <a href="lecturer_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="lecturer_profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="create_course.php"><i class="fas fa-book"></i> Create Course</a>
    <a href="create_test.php"><i class="fas fa-pen"></i> Create Test</a>
    <a href="create_assignment.php"><i class="fas fa-upload"></i> Create Assignment</a>
    <a href="upload_slides.php"><i class="fas fa-file-upload"></i> Upload Slides</a>
    <a href="view_submissions.php"><i class="fas fa-file-alt"></i> Submissions</a>
    <a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar" style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Welcome Lecturer</h2>

        <div style="display:flex; align-items:center; gap:10px;">
            <i class="fas fa-user-circle"></i>

            <div>
                <b><?php echo htmlspecialchars($lecturerName); ?></b><br>
                <small><?php echo htmlspecialchars($email); ?></small>
            </div>
        </div>
    </div>

    <!-- STATS -->
    <div style="display:flex; gap:15px; margin-bottom:20px;">
        <div class="card">
            <h3><i class="fas fa-book"></i> Courses</h3>
            <p><?php echo $courseCount; ?></p>
        </div>

        <div class="card">
            <h3><i class="fas fa-tasks"></i> Assignments</h3>
            <p><?php echo $assignmentCount; ?></p>
        </div>

        <div class="card">
            <h3><i class="fas fa-file-alt"></i> Submissions</h3>
            <p><?php echo $submissionCount; ?></p>
        </div>
    </div>

    <!-- MY COURSES -->
    <h2 class="section-title">My Courses</h2>

    <div class="course-grid">
        <?php
        $courseList = $conn->query("SELECT * FROM courses WHERE lecturer_email='$email'");

        if ($courseList && $courseList->num_rows > 0) {
            while ($row = $courseList->fetch_assoc()) {
                echo "<div class='course-card'>";
                echo "<b>Course Name:</b> " . htmlspecialchars($row['course_name']) . "<br>";
                echo "<b>Lecturer:</b> " . htmlspecialchars($lecturerName) . "<br>";
                echo "</div>";
            }
        } else {
            echo "<div class='course-card'>No courses created yet.</div>";
        }
        ?>
    </div>

    <!-- QUICK ACTIONS -->
    <h2 class="section-title">Quick Actions</h2>

    <div style="margin-top:20px;">
        <div class="card">
            <h3>Create Course</h3>
            <p>Add new courses for students.</p>
            <a href="create_course.php"><button>Create Course</button></a>
        </div>

        <div class="card">
            <h3>Create Assignment</h3>
            <p>Upload new assignments for students.</p>
            <a href="create_assignment.php"><button>Create Assignment</button></a>
        </div>

        <div class="card">
            <h3>Upload Slides</h3>
            <p>Upload lecture materials for students.</p>
            <a href="upload_slides.php"><button>Upload Slides</button></a>
        </div>

        <div class="card">
            <h3>View Submissions</h3>
            <p>Check student work and grade submissions.</p>
            <a href="view_submissions.php"><button>View Submissions</button></a>
        </div>
    </div>

</div>

</body>
</html>
