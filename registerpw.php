<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SISVORA - Create Password</title>

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
    .logo-area .logo-text {
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
        font-size:22px;
        font-weight:700;
        margin-bottom:8px;
    }
    .title p {
        color:#555;
        font-size:15px;
    }

    /* Input */
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

    /* Checkbox */
    .checkbox-group {
        display:flex;
        gap:12px;
        font-size:13px;
        color:#333;
        margin:20px 0 10px;
    }
    .checkbox-group input {
        margin-top:3px;
    }
    .checkbox-group a {
        color:#d66933;
        text-decoration:none;
    }

    /* Submit Button */
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
    }
    button:hover {
        background:#b05f31;
    }

    /* Responsive */
    @media (max-width:700px) {
        body { padding:40px 30px; }
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
    <h2>Create Password</h2>
    <p>Please create your password below.</p>
</div>

<form id="passwordForm">

    <div class="form-group">
        <label>PASSWORD</label>
        <input type="password" id="pw1">
    </div>

    <div class="form-group">
        <label>CONFIRM PASSWORD</label>
        <input type="password" id="pw2">
    </div>

    <div class="checkbox-group">
        <input type="checkbox" id="terms">
        <label for="terms">
            I agree to SISVORA's <a href="#">Terms & Service</a> and <a href="#">Privacy Policy</a>
        </label>
    </div>

    <button type="submit">REGISTER</button>

</form>

<script>
document.getElementById("passwordForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let pw1 = document.getElementById("pw1").value;
    let pw2 = document.getElementById("pw2").value;
    let terms = document.getElementById("terms").checked;

    if (!pw1 || !pw2) {
        alert("Password fields cannot be empty.");
        return;
    }

    if (pw1 !== pw2) {
        alert("Passwords do not match.");
        return;
    }

    if (!terms) {
        alert("You must agree to the terms.");
        return;
    }

    alert("Account created successfully!");
    window.location.href = "loginuser.php";
});
</script>

</body>
</html>
