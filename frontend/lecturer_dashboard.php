<?php
session_start();

// protect page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("../backend/db.php");

// Dashboard stats
$courses = $conn->query("SELECT COUNT(*) as total FROM courses")->fetch_assoc()['total'];
$assignments = $conn->query("SELECT COUNT(*) as total FROM assignments")->fetch_assoc()['total'];
$submissions = $conn->query("SELECT COUNT(*) as total FROM submissions")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>LMS</h2>



    <a href="lecturer_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>

    <!-- ✅ ADDED PROFILE -->
    <a href="lecturer_profile.php"><i class="fas fa-user"></i> Profile</a>

    <a href="create_course.php"><i class="fas fa-book"></i> Create Course</a>

    <a href="create_test.php"><i class="fas fa-pen"></i> Create Test</a>

    <a href="create_assignment.php"><i class="fas fa-upload"></i> Create Assignment</a>

    <!-- ✅ ADDED UPLOAD SLIDES -->
    <a href="upload_slides.php"><i class="fas fa-file-upload"></i> Upload Slides</a>

    <a href="view_submissions.php"><i class="fas fa-file-alt"></i> Submissions</a>

    <a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

<div class="topbar" style="display:flex; justify-content:space-between; align-items:center;">

    <h2>Welcome Lecturer</h2>

    <div style="display:flex; align-items:center; gap:15px;">

      

        <div style="display:flex; align-items:center; gap:10px;">
            <i class="fas fa-user-circle"></i>
            <span><?php echo $_SESSION['email']; ?></span>
        </div>

    </div>

</div>

<!-- 🔥 STATS CARDS -->
<div style="display:flex; gap:15px; margin-bottom:20px;">

<div class="card">
    <h3><i class="fas fa-book"></i> Courses</h3>
    <p><?php echo $courses; ?></p>
</div>

<div class="card">
    <h3><i class="fas fa-tasks"></i> Assignments</h3>
    <p><?php echo $assignments; ?></p>
</div>

<div class="card">
    <h3><i class="fas fa-file-alt"></i> Submissions</h3>
    <p><?php echo $submissions; ?></p>
</div>

</div>

<!-- ACTION CARDS -->
<div class="card">
    <h3>Quick Actions</h3>
    <p>Use the menu on the left to manage courses, assignments, and submissions.</p>
</div>

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


</body>
</html>