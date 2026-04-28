<!DOCTYPE html>
<html>
<head>
<title>LMS Home</title>

<style>
body {
    margin:0;
    font-family:'Segoe UI';
    background:url('https://images.unsplash.com/photo-1523240795612-9a054b0db644') no-repeat center/cover;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

body::before {
    content:"";
    position:fixed;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.7);
    z-index:-1;
}

.hero {
    text-align:center;
    color:white;
    background:rgba(255,255,255,0.08);
    padding:40px;
    border-radius:12px;
}

button {
    padding:10px 20px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

button:hover {
    background:#1e40af;
}
</style>
</head>

<body>

<div class="hero">
    <h1>Learning Management System</h1>
    <p>Manage courses, assignments, and tests easily</p>

    <a href="frontend/login.php">
        <button>Login</button>
    </a>
</div>

</body>
</html>