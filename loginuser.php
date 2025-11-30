<?php 
session_start();

if (isset($login_success) && $login_success === true) {
    if (isset($data['nis'])) {
        $_SESSION['nis'] = $data['nis'];
    }
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

    .logo-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.hero-logo-img {
    width: 120px;
    height: auto;
    display: block;
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
<<<<<<< HEAD

<div class="logo-area">
    <img src="img/logo.png" alt="SISVORA Logo" style="max-width:150px; display:block; margin:auto;">
=======
</div><div class="logo-area">
  <div class="logo-area">
    <img src="img/logo.png" alt="SISVORA Logo" class="hero-logo-img main-logo">
>>>>>>> d9a5d8eafb8c2b9bf6ce497eb60278d6f383a933
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
