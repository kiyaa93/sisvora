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

.main-logo {
    width: 110px;  /* bebas atur */
}

.logo-text {
    font-size: 32px;
    font-weight: bold;
    color: #d64933;
    text-align: center;
    margin-top: 5px;
}


    /* Title Text */
    .title {
        max-width:900px;
        margin:auto;
        margin-bottom:30px;
    }
    .title h2 {
        font-size:22px;
        font-weight:700;
        margin-bottom:5px;
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

<body>
</div><div class="logo-area">
  <div class="logo-area">
    <img src="img/logo.png" alt="SISVORA Logo" class="hero-logo-img main-logo">
</div>

<div class="title">
    <h2>Welcome!</h2>
    <p>Please fill out your information below.</p>
</div>

<form action="registerpw.php" method="POST">

    <div class="row">
        <div>
            <label>FIRST NAME</label>
            <input type="text" name="first_name" required>
        </div>

        <div>
            <label>MIDDLE NAME</label>
            <input type="text" name="middle_name">
        </div>

        <div>
            <label>LAST NAME</label>
            <input type="text" name="last_name">
        </div>
    </div>

    <div class="row-2">
        <div>
            <label>NIS</label>
            <input type="text" name="nis" required>
        </div>

        <div>
            <label>BIRTHDAY</label>
            <input type="date" name="birthday" required>
        </div>
    </div>

    <div class="row-2">
        <div>
            <label>CONTACT NUMBER</label>
            <div class="contact-wrapper">
                <div class="country-code">+62 🇮🇩</div>
                <input type="tel" name="contact">
            </div>
        </div>

        <div>
            <label>EMAIL</label>
            <input type="email" name="email">
        </div>
    </div>

    <div class="row">
        <div>
            <label>PASSWORD</label>
            <input type="password" name="password" required>
        </div>
    </div>

    <button type="submit">SUBMIT</button>

</form>

</body>
</html>
