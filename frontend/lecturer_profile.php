<?php
session_start();
include("../backend/db.php");

// protect page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fixed lecturer info (as you wanted)
$name = "Mr. Harry-Atieku";
$school = "Pentecost University";
$faculty = "Faculty of Engineering and Science (FESAC)";
$department = "IT";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lecturer Profile</title>

    <link rel="stylesheet" href="../assets/style.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;

            /* 🔥 NEW PROFILE-STYLE BACKGROUND */
            background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)),
                        url('https://images.unsplash.com/photo-1519389950473-47ba0277781c') no-repeat center/cover;

            min-height: 100vh;
        }

        .profile-container {
            max-width: 600px;
            margin: 80px auto;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            color: white;
            box-shadow: 0px 8px 25px rgba(0,0,0,0.4);
        }

        .profile-icon {
            font-size: 70px;
            margin-bottom: 10px;
            color: #3b82f6;
        }

        .profile-container h2 {
            margin-bottom: 5px;
        }

        .profile-container p {
            margin: 8px 0;
            opacity: 0.9;
        }

        .divider {
            margin: 20px 0;
            border: 1px solid rgba(255,255,255,0.2);
        }
    </style>
</head>

<body>

<div class="profile-container">

    <!-- Profile Icon -->
    <i class="fas fa-user-circle profile-icon"></i>

    <h2><?php echo $name; ?></h2>
    <p><?php echo $email; ?></p>

    <div class="divider"></div>

    <p><b>School:</b> <?php echo $school; ?></p>
    <p><b>Faculty:</b> <?php echo $faculty; ?></p>
    <p><b>Department:</b> <?php echo $department; ?></p>

</div>

<!-- Font Awesome (for icon) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>

</body>
</html>