<?php session_start(); 
    if ($login_success) {
    $_SESSION['voter_id'] = $data['id']; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SISVORA - Login User</title>

<style>
    * { margin:0; padding:0; box-sizing:border-box; }

    body {
        background:#f4ecdf;
        font-family:"Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        padding:60px 80px;
        color:#333;
    }

    /* Logo Area */
    .logo-area {
        text-align:center;
        margin-bottom:40px;
    }
    .logo-area svg {
        width:90px;
        height:90px;
    }
    .logo-text {
        color:#d66933;
        font-size:24px;
        font-weight:700;
        margin-top:10px;
    }

    /* Title */
    .title {
        max-width:600px;
        margin:auto;
        margin-bottom:35px;
        text-align:center;
    }
    .title h2 {
        font-size:24px;
        font-weight:700;
        margin-bottom:8px;
    }
    .title p {
        font-size:15px;
        color:#555;
    }

    /* Form */
    form {
        max-width:450px;
        margin:auto;
    }

    .form-group {
        margin-bottom:22px;
    }

    label {
        font-size:12px;
        font-weight:600;
        letter-spacing:0.5px;
        margin-bottom:5px;
        display:block;
    }

    input {
        width:100%;
        padding:13px 18px;
        border-radius:30px;
        border:2px solid #d4b8a2;
        background:white;
        font-size:14px;
        outline:none;
        transition:0.2s;
    }

    input:focus {
        border-color:#d66933;
    }

    /* Button */
    button {
        display:block;
        margin:30px auto 0;
        padding:14px 40px;
        background:#c36b3b;
        border:none;
        border-radius:30px;
        color:white;
        font-size:16px;
        font-weight:700;
        cursor:pointer;
        box-shadow:0 4px 0 #8b4723;
        transition:0.2s;
        width:100%;
    }
    button:hover {
        background:#b05f31;
    }

    /* Footer links */
    .footer-links {
        text-align:center;
        margin-top:20px;
        font-size:13px;
    }
    .footer-links a {
        color:#d66933;
        text-decoration:none;
    }

    @media (max-width:700px) {
        body { padding:40px 25px; }
    }
</style>
</head>

<body>

<div class="logo-area">
    <svg viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="none" stroke="#d64933" stroke-width="3"/>
        <circle cx="50" cy="35" r="12" fill="#d64933"/>
        <path d="M 30 70 Q 50 55 70 70" fill="none" stroke="#d64933" stroke-width="3"/>
    </svg>
    <div class="logo-text">SISVORA</div>
</div>

<div class="title">
    <h2>Welcome Back!</h2>
    <p>Please login to vote for your preferred candidate.</p>
</div>

<form method="POST" action="proses_login_user.php">

    <div class="form-group">
        <label for="nis">NIS</label>
        <input type="text" id="nis" name="nis" required>
    </div>

    <div class="form-group">
        <label for="password">PASSWORD</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">LOGIN</button>

    <div class="footer-links">
        <br>
        <a href="loginadmin.php">Sign in as Admin</a><br><br>
        Don't have an account? <a href="register.php">Register here</a>
    </div>

</form>

</body>
</html>
