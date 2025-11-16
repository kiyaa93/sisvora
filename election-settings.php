<?php
// KONEKSI DATABASE
require 'config.php';

// Ambil data election untuk ditampilkan (optional)
$query = mysqli_query($conn, "SELECT * FROM elections ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SISVORA - Election Settings</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --orange-primary: #D2691E;
        --orange-light: #F4A460;
        --orange-dark: #8B4513;
        --beige-bg: #F5E6D3;
        --beige-sidebar: #E8D4BF;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--beige-bg);
        overflow-x: hidden;
    }
    .navbar {
        background-color: var(--beige-sidebar);
        padding: 1rem 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .navbar-toggle-btn {
        background: none;
        border: none;
        color: var(--orange-primary);
        font-size: 1.8rem;
        cursor: pointer;
        transition: .3s ease;
    }

    .navbar-toggle-btn:hover {
        color: var(--orange-dark);
        transform: scale(1.1);
    }
    
    .navbar .logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--orange-primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .navbar .logo i { font-size: 1.8rem; }
    .navbar .search-bar { max-width: 600px; flex-grow: 1; }
    .navbar .search-bar input {
        border-radius: 25px; border: 2px solid #ddd; padding: 0.6rem 1.5rem;
    }
    .navbar .search-bar input:focus {
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 0.2rem rgba(210, 105, 30, 0.25);
    }
    .icon-btn {
        background: none; border: none; color: var(--orange-primary);
        font-size: 1.5rem; cursor: pointer; transition: all 0.3s; position: relative;
    }
    .icon-btn:hover { color: var(--orange-dark); transform: scale(1.1); }
    .notification-badge {
        position: absolute; top: -5px; right: -5px; background-color: #dc3545;
        color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 0.7rem;
        display: flex; align-items: center; justify-content: center;
    }
    /* Sidebar */
    .sidebar-wrapper {
        position: fixed; left: 0; top: 76px; height: calc(100vh - 76px);
        width: 280px; background-color: var(--beige-sidebar);
        box-shadow: 2px 0 4px rgba(0,0,0,0.1); transition: transform 0.3s ease;
        z-index: 999; overflow-y: auto;
    }
    .sidebar-wrapper.collapsed { transform: translateX(-280px); }
    .sidebar.collapsed { width: 85px; }
    .sidebar.collapsed .menu-text { display: none; }
    .user-profile {
        text-align: center; padding: 2rem 1rem;
        background: linear-gradient(135deg, rgba(210, 105, 30, 0.1), rgba(244, 164, 96, 0.1));
        border-bottom: 2px solid rgba(210, 105, 30, 0.2);
    }
    .user-profile .avatar {
        width: 80px; height: 80px;
        background: linear-gradient(135deg, var(--orange-primary), var(--orange-light));
        border-radius: 50%; margin: 0 auto 1rem;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 2rem; box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .user-profile h5 { color: var(--orange-dark); font-weight: bold; margin-bottom: 0.3rem; }
    .user-profile p { color: #666; font-size: 0.9rem; }
    .sidebar-menu { padding: 1rem 0; }
    .menu-item {
        padding: 1rem 1.5rem; color: var(--orange-dark); text-decoration: none;
        display: flex; align-items: center; gap: 1rem; transition: all 0.3s;
        border-left: 4px solid transparent; font-weight: 500; cursor: pointer;
    }
    .menu-item:hover { background-color: rgba(210, 105, 30, 0.1); color: var(--orange-primary); border-left-color: var(--orange-primary); }
    .menu-item.active { background-color: var(--orange-primary); color: white; border-left-color: var(--orange-dark); }
    .menu-item.active i { animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100% {transform:scale(1);} 50% {transform:scale(1.1);} }
    .menu-separator {
        margin: 1rem 1.5rem; border-top: 1px solid rgba(210, 105, 30, 0.2);
    }
    .content { margin-left: 280px; padding: 2rem; transition: margin-left 0.3s ease; min-height: calc(100vh - 76px); }
    .content.expanded { margin-left: 0; }
    .election-card {
        background: white; border-radius: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); 
        padding: 20px; display: flex; justify-content: space-between; align-items: center;
        border: 2px solid #efc7a6;
    }
    .create-card {
        background: #fff; border: 2px dashed #c97d46; border-radius: 18px;
        padding: 50px 10px; text-align: center; color: #c97d46;
        cursor: pointer; transition: 0.2s;
    }
    .create-card:hover { background: #fcefe3; }
    .btn-delete {
        background: white; border: 2px solid #d56b32; color: #d56b32;
        border-radius: 20px; padding: 6px 18px; font-size: 14px; font-weight: 600;
    }
    .btn-delete:hover { background: #d56b32; color: white; }
    .election-modal {
        border-radius: 18px;
        padding: 10px 20px;
        background: #fffdf9;
    }

    .election-input {
        border: 1px solid #e6b48c;
        border-radius: 10px;
        padding: 10px;
        background: #fffefc;
    }

    .create-card {
        background: #fffaf2;
        border: 2px dashed #e6b48c;
        border-radius: 20px;
        padding: 40px 20px;
        text-align: center;
        transition: 0.2s;
    }

    .create-card:hover {
        background: #ffeede;
        cursor: pointer;
    }

    .save-election-btn {
        background: #b04b0f;
        color: white;
        border-radius: 12px;
    }

    .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.35);
            backdrop-filter: blur(3px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-box {
            width: 450px;
            background: #ffff;
            padding: 30px 35px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .modal-icon {
            font-size: 55px;
            color: #c45a09;
            margin-bottom: 10px;
        }

        .modal-box h2 {
            font-size: 26px;
            margin-bottom: 8px;
            color: #3d2b1f;
        }

        .modal-box p {
            color: #6f5845;
            margin-bottom: 25px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-cancel {
            padding: 10px 25px;
            border: 2px solid #c45a09;
            color: #c45a09;
            background: transparent;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-confirm {
            padding: 10px 25px;
            border: none;
            color: white;
            background: #c45a09;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: rgba(196, 90, 9, 0.08);
        }

        .btn-confirm:hover {
            background: #a24907;
        }
</style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggle-btn me-3" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <a href="#" class="logo"><i class="fas fa-vote-yea"></i><span>SISVORA</span></a>
        <div class="search-bar mx-4 d-none d-md-block">
            <input type="search" class="form-control" placeholder="🔍 Search...">
        </div>
        <div class="d-flex gap-3 align-items-center">
            <button class="icon-btn"><i class="fas fa-bell"></i><span class="notification-badge">3</span></button>
            <button class="icon-btn"><i class="fas fa-question-circle"></i></button>
            <button class="icon-btn"><i class="fas fa-user-circle"></i></button>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar-wrapper" id="sidebar">
    <div class="user-profile">
        <div class="avatar"><i class="fas fa-user"></i></div>
        <h5>Admin_ID</h5>
        <p class="text-muted">Administrator</p>
    </div>

    <nav class="sidebar-menu">
        <a href="dashboard.php" class="menu-item"><i class="fas fa-home"></i><span>Dashboard</span></a>
        <a href="voters-data.php" class="menu-item"><i class="fas fa-users"></i><span>Voters Data</span></a>
        <a href="candidate-data.php" class="menu-item"><i class="fas fa-user-tie"></i><span>Candidate Data</span></a>
        <a href="election-settings.php" class="menu-item active"><i class="fas fa-cog"></i><span>Election Settings</span></a>
        <a href="result&report.php" class="menu-item"><i class="fas fa-chart-bar"></i><span>Results & Report</span></a>
        <div class="menu-separator"></div>
        <a href="#" id="logoutMenu" class="menu-item"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
        </nav>
    </div>

    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon">⚠️</div>

            <h2>Are you sure to leave?</h2>
            <p>You can always login back any time.</p>

            <div class="modal-actions">
                <button id="cancelLogout" class="btn-cancel">CANCEL</button>
                <button id="confirmLogout" class="btn-confirm">YES, I'M SURE</button>
            </div>
        </div>
    </div>

<!-- MAIN CONTENT -->
<div class="content">
    <h3 class="fw-bold mb-4">Available Election</h3>

    <div class="row g-4">
        <!-- LOOPING DATA ELECTION -->
        <?php while($row = mysqli_fetch_assoc($query)) { ?>

        <div class="col-md-6">
            <div class="election-card">
                <div>
                    <small class="text-muted">Ongoing Elections</small>
                    <h5 class="fw-bold mt-1"><?= $row['election_name']; ?></h5>
                    <form action="delete-election.php" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <button class="btn-delete mt-2" onclick="return confirm('Delete election?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- CREATE NEW -->
        <div class="col-md-6">
            <div class="create-card" id="openElectionModal">
                <div class="fs-1">+</div>
                <div class="fw-bold mt-2">Create</div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL POPUP -->
<div class="modal fade" id="addElectionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content election-modal">

        <h5 class="text-center fw-bold mt-2">SISVORA ELECTION</h5>

        <?php if(isset($_GET['msg'])) : ?>
            <p class="text-center text-success fw-semibold"><?= $_GET['msg']; ?></p>
        <?php endif; ?>

        <form action="save-election.php" method="POST">
            <div class="modal-body">
                <label class="fw-semibold">Election Name :</label>
                <input type="text" name="election_name" class="form-control election-input mb-3" required>

                <label class="fw-semibold">Voting Period :</label>
                <input type="date" name="period" class="form-control election-input mb-3" required>

                <label class="fw-semibold">Start Hour :</label>
                <input type="time" name="start_time" class="form-control election-input mb-3" required>

                <label class="fw-semibold">Close Hour :</label>
                <input type="time" name="end_time" class="form-control election-input mb-3" required>

                <label class="fw-semibold d-block">Voting Status :</label>
                <label><input type="radio" name="status" value="Aktif" required> Aktif</label>
                <label><input type="radio" name="status" value="NonAktif"> Non-Aktif</label>
                
            <div class="text-center mb-4">
                <button class="btn save-election-btn px-4 fw-semibold">SAVE</button>
            </div>
        </form>    
    </div>
  </div>
</div>

<!-- Bootstrap & Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById("openElectionModal").addEventListener("click", function () {
    var modal = new bootstrap.Modal(document.getElementById("addElectionModal"));
    modal.show();
});
</script>

<script>
// SHOW MODAL
        const logoutMenu = document.getElementById("logoutMenu"); // tombol logout kamu
        const logoutModal = document.getElementById("logoutModal");
        const cancelLogout = document.getElementById("cancelLogout");
        const confirmLogout = document.getElementById("confirmLogout");

        logoutMenu.addEventListener("click", function(e) {
            e.preventDefault();
            logoutModal.style.display = "flex";
        });

        cancelLogout.addEventListener("click", function() {
            logoutModal.style.display = "none";
        });

        // Proses logout
        confirmLogout.addEventListener("click", function() {
            window.location.href = "/logout"; 
        });

// SIDEBAR RESPONSIVE
function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("collapsed");
        document.getElementById("mainContent").classList.toggle("expanded");
    }
</script>

<script>
function updateCountdown() {
    const date = document.querySelector('input[type="date"]').value;
    const start = document.querySelectorAll('input[type="time"]')[0].value;
    const end = document.querySelectorAll('input[type="time"]')[1].value;
    const box = document.getElementById('countdownBox');

    if (!date || !start || !end) {
        box.style.display = "none";
        return;
    }

    const startDateTime = new Date(date + " " + start);
    const now = new Date();
    
    if (startDateTime <= now) {
        box.style.display = "block";
        box.innerHTML = "⚠ Start time must be greater than current time!";
        box.style.color = "red";
        return;
    }

    box.style.display = "block";
    box.style.color = "var(--orange-dark)";

    function renderCountdown() {
        const nowTime = new Date();
        const diff = startDateTime - nowTime;

        if (diff <= 0) {
            box.innerHTML = "⏱ Voting Ready to Start!";
            return;
        }

        let d = Math.floor(diff / (1000 * 60 * 60 * 24));
        let h = Math.floor((diff / (1000 * 60 * 60)) % 24);
        let m = Math.floor((diff / (1000 * 60)) % 60);
        let s = Math.floor((diff / 1000) % 60);

        box.innerHTML = `⏳ Voting will start in: <br> <b>${d}d ${h}h ${m}m ${s}s</b>`;
    }

    renderCountdown();
    setInterval(renderCountdown, 1000);
}

// bind listeners on inputs
document.querySelector('input[type="date"]').addEventListener('change', updateCountdown);
document.querySelectorAll('input[type="time"]')[0].addEventListener('change', updateCountdown);
document.querySelectorAll('input[type="time"]')[1].addEventListener('change', updateCountdown);
</script>

</body>
</html>