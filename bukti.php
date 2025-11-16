<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SISVORA – Bukti Suara</title>

<style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:Arial;}
    body{background:#f4f4f4;}

    nav{
        position:fixed;
        top:0; left:0;
        width:100%;
        height:60px;
        background:#222;
        color:#fff;
        display:flex;
        align-items:center;
        padding:0 20px;
        justify-content:space-between;
        z-index:10;
    }
    nav .logo img{height:40px;}
    nav ul{display:flex;list-style:none;gap:25px;}
    nav ul li a{color:white;text-decoration:none;font-weight:bold;}
    nav ul li a:hover{color:#ff9800;}

    .content{
        padding:80px 20px;
    }

    .box{
        background:white;
        padding:20px;
        border-radius:10px;
        box-shadow:0 2px 5px rgba(0,0,0,0.1);
    }
</style>

</head>
<body>

<nav>
    <div class="logo">
        <img src="img/logo.png">
    </div>

    <ul>
        <li><a href="dashboard.html">Dashboard</a></li>
        <li><a href="notification.html">Notification</a></li>
        <li><a href="bukti.html">Bukti Suara</a></li>
        <li><a href="#">Logout</a></li>
    </ul>
</nav>

<div class="content">
    <div class="box">
        <h2>Bukti Suara</h2>
        <p>Halaman ini masih kosong. Kamu bisa menambahkan bukti gambar, tabel, atau log suara nanti.</p>
    </div>
</div>

<script>
    console.log("Bukti Suara loaded");
</script>

</body>
</html>
