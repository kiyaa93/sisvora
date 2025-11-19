<?php
require "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $nis = $_POST['nis'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO login_user 
            (first_name, last_name, nis, birthday, contact, email, password)
            VALUES 
            ('$first', '$last', '$nis', '$birthday', '$contact', '$email', '$hashedPass')";

    if (mysqli_query($conn, $sql)) {
        echo "Register berhasil!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SISVORA - Registration Biodata</title>

<style>
    * { margin:0; padding:0; box-sizing:border-box; }

    body {
        background:#f4ecdf;
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
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
    .logo-area .logo-text {
        color:#d66933;
        font-size:24px;
        font-weight:700;
        margin-top:10px;
    }

    /* Title Text */
    .title {
        max-width:900px;
        margin:auto;
        margin-bottom:35px;
    }
    .title h2 {
        font-size:22px;
        font-weight:700;
        margin-bottom:8px;
    }
    .title p {
        color:#555;
        font-size:15px;
    }

    /* Form layout */
    form {
        max-width:900px;
        margin:auto;
    }

    .row {
        display:grid;
        grid-template-columns: repeat(3, 1fr);
        gap:22px;
        margin-bottom:25px;
    }

    .row-2 {
        display:grid;
        grid-template-columns: repeat(2, 1fr);
        gap:22px;
        margin-bottom:25px;
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

    /* contact input */
    .contact-wrapper {
        display:flex;
        align-items:center;
        gap:10px;
    }

    .country-code {
        display:flex;
        align-items:center;
        font-size:14px;
        font-weight:600;
    }

    /* Submit Button */
    button {
        display:block;
        margin:40px auto 0;
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
    }

    button:hover {
        background:#b05f31;
    }

    /* Responsive */
    @media (max-width:900px) {
        body { padding:40px 30px; }

        .row { grid-template-columns:1fr; }
        .row-2 { grid-template-columns:1fr; }
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
    <h2>Welcome!</h2>
    <p>Please fill out your information below.</p>
</div>

<form action="registerpw.php">

    <div class="row">
        <div>
            <label>FIRST NAME</label>
            <input type="text">
        </div>

        <div>
            <label>MIDDLE NAME</label>
            <input type="text">
        </div>

        <div>
            <label>LAST NAME</label>
            <input type="text">
        </div>
    </div>

    <div class="row-2">
        <div>
            <label>NIS</label>
            <input type="text">
        </div>

        <div>
            <label>BIRTHDAY</label>
            <input type="date">
        </div>
    </div>

    <div class="row-2">
        <div>
            <label>CONTACT NUMBER</label>
            <div class="contact-wrapper">
                <div class="country-code">+62 🇮🇩</div>
                <input type="tel">
            </div>
        </div>

        <div>
            <label>EMAIL</label>
            <input type="email">
        </div>
    </div>

    <button type="submit">SUBMIT</button>

</form>

</body>
</html>
