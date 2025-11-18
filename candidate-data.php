<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA – Candidate</title>

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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--beige-bg);
            overflow-x: hidden;
        }
        
        /* Navbar Styles */
        .navbar {
            background-color: var(--beige-bg);
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            left: 0;
            width: 100%;
            z-index: 2000;
        }
        
        .navbar-toggle-btn {
            background: none;
            border: none;
            color: var(--orange-primary);
            font-size: 1.8rem;
            cursor: pointer;
            transition: .3s ease;
            margin-right: -10px;
        }

        .navbar-toggle-btn:hover {
            color: var(--orange-dark);
            transform: scale(1.1);
        }

        .navbar .logo {
            font-size: 1.2rem;
            margin-left: 8px;
            font-weight: bold;
            color: var(--orange-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .logo img {
            height: 45px;   /* sesuaikan */
            width: auto;
            object-fit: contain;
            transform: scale(1.5);
        }
        
        .navbar .search-bar {
            max-width: 600px;
            flex-grow: 1;
        }
        
        .navbar .search-bar input {
            border-radius: 25px;
            border: 2px solid #ddd;
            padding: 0.6rem 1.5rem;
        }
        
        .navbar .search-bar input:focus {
            border-color: var(--orange-primary);
            box-shadow: 0 0 0 0.2rem rgba(210, 105, 30, 0.25);
        }
        
        .icon-btn {
            background: none;
            border: none;
            color: var(--orange-primary);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }
        
        .icon-btn:hover {
            color: var(--orange-dark);
            transform: scale(1.1);
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Sidebar Styles */
        .sidebar-wrapper {
            position: fixed;
            left: 0;
            top: 80px;
            height: 100vh;
            width: 280px;
            background-color: var(--beige-sidebar);
            border-top: 1px solid rgba(0,0,0,0.08);
            border-top-right-radius: 50px;
            box-shadow: 2px 0 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            z-index: 999;
        }
        
        .sidebar-wrapper.collapsed {
            transform: translateX(-280px);
        }
        
        .sidebar.collapsed {
            width: 85px;
        }

        .sidebar.collapsed .menu-text {
            display: none;
        }

        .user-profile {
            text-align: center;
            padding: 2rem 1rem;
            background: linear-gradient(135deg, rgba(210, 105, 30, 0.1), rgba(244, 164, 96, 0.1));
            border-bottom: 2px solid rgba(210, 105, 30, 0.2);
        }
        
        .user-profile .avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--orange-primary), var(--orange-light));
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .admin-id {
            color: var(--orange-dark);
            font-weight: bold;
            font-size: 1.3rem;
            margin-bottom: 0.3rem;
        }
        
        .user-profile p {
            color: #666;
            font-size: 0.9rem;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            padding: 1rem 1.5rem;
            color: var(--orange-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            font-weight: 500;
            cursor: pointer;
        }
        
        .menu-item i {
            width: 24px;
            font-size: 1.2rem;
            text-align: center;
        }
        
        .menu-item:hover {
            background-color: rgba(210, 105, 30, 0.1);
            color: var(--orange-primary);
            border-left-color: var(--orange-primary);
        }
        
        .menu-item.active {
            background-color: var(--orange-primary);
            color: white;
            border-left-color: var(--orange-dark);
        }
        
        .menu-item.active i {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .menu-separator {
            margin: 1rem 1.5rem;
            border-top: 1px solid rgba(210, 105, 30, 0.2);
        }

        /* CONTENT */
        .main-content {
            padding: 2.3rem;
            padding-top: 120px;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 76px);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .btn-add {
            border: none;
            color: #c45a09;
            background: white;
            border-radius: 20px;
        }

        .btn-add:hover {
            color: white;
            background: #a24907;
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

        /* OVERLAY */
        .notif-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.2);
            display: none;
            backdrop-filter: blur(2px);
            z-index: 2000;
        }

        /* PANEL */
        .notif-panel {
            position: fixed;
            top: 0;
            right: -380px; 
            width: 350px;
            height: 100%;
            background: #fff;
            box-shadow: -3px 0 15px rgba(0,0,0,.15);
            padding: 20px;
            z-index: 2100;
            transition: right .3s ease;
            overflow-y: auto;
            border-left: 1px solid #eee;
        }

        /* HEADER */
        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .notif-close {
            cursor: pointer;
            font-size: 22px;
            padding: 0 5px;
        }

        .notif-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            background: #fff7f0;
            border-radius: 10px;
            border: 1px solid #eee;
            margin-bottom: 12px;
        }

        .notif-item h4 {
            margin: 0;
        }
        .notif-item p {
            margin-top: 3px;
            font-size: 13px;
            color: #666;
        }

        .notif-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
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
            <a href="#" class="logo">
                <img src="img/logo.png" alt="SISVORA Logo" class="logo-img">
                <span>SISVORA</span>
            </a>
            <div class="search-bar mx-4 d-none d-md-block">
                <input type="search" class="form-control" placeholder="🔍 Search...">
            </div>
            <div class="d-flex gap-3 align-items-center">
                <button class="icon-btn" id="notifBtn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <button class="icon-btn" title="Help">
                    <i class="fas fa-question-circle"></i>
                </button>
                <button class="icon-btn" title="Profile">
                    <i class="fas fa-user-circle"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar-wrapper" id="sidebar">
        <div class="user-profile">
            <div class="avatar"><i class="fas fa-user"></i></div>
            <div class="admin-id">Admin_ID</div>
            <p class="text-muted">Administrator</p>
        </div>

        <nav class="sidebar-menu">
            <a href="dashboard.php" class="menu-item"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <a href="voters-data.php" class="menu-item"><i class="fas fa-users"></i><span>Voters Data</span></a>
            <a href="candidate-data.php" class="menu-item active"><i class="fas fa-user-tie"></i><span>Candidate Data</span></a>
            <a href="election-settings.php" class="menu-item"><i class="fas fa-cog"></i><span>Election Settings</span></a>
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

    <div class="main-content" id="mainContent">
    <h3 class="fw-bold mb-4">Candidate Data</h3>
    <a href="add-candidate.php" class="btn btn-add mb-3"><i class="fa fa-plus me-2"></i> Add Candidate</a>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kandidat</th>
                    <th>Urutan</th>
                    <th>Jenis</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($candidates)): ?>
                    <tr><td colspan="8" class="text-muted">Belum ada data kandidat</td></tr>
                <?php else: ?>
                    <?php foreach ($candidates as $idx => $c): ?>
                        <tr>
                            <td><?= $idx + 1 ?></td>
                            <td><?= htmlspecialchars($c['nama_kandidat']) ?></td>
                            <td><?= htmlspecialchars($c['urutan_kandidat']) ?></td>
                            <td><?= htmlspecialchars($c['jenis_kandidat']) ?></td>
                            <td><?= htmlspecialchars($c['visi']) ?></td>
                            <td><?= htmlspecialchars($c['misi']) ?></td>
                            
                            <td>
                                <?php if (!empty($c['foto']) && file_exists(__DIR__ . '/uploads/' . $c['foto'])): ?>
                                    <img src="uploads/<?= htmlspecialchars($c['foto']) ?>" alt="foto">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <td><?= (int)$c['votes'] ?></td>

                            <td>
                                <a href="add-candidate.php?id=<?= $c['id'] ?>" title="Edit">
                                    <i class="fa-solid fa-pen-to-square icon-action"></i>
                                </a>

                                <a href="delete_candidate.php?id=<?= $c['id'] ?>"
                                onclick="return confirm('Yakin ingin menghapus kandidat ini?')"
                                title="Delete">
                                    <i class="fa-solid fa-trash icon-action"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

    <!-- OVERLAY -->
    <div id="notifOverlay" class="notif-overlay"></div>

    <!-- SLIDE PANEL -->
    <div id="notifPanel" class="notif-panel">

        <div class="notif-header">
            <h2>Notification</h2>
            <span class="notif-close">&times;</span>
        </div>

        <div class="notif-item">
            <img src="img/logo.png" class="notif-icon">
            <div>
                <h4>Let’s choose your choice!</h4>
                <p>Make sure that you carefully read the candidate’s vision and mission.</p>
            </div>
        </div>

        <div class="notif-item">
            <img src="img/logo.png" class="notif-icon">
            <div>
                <h4>New Update</h4>
                <p>Voting results will be announced soon.</p>
            </div>
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar Toggle
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("collapsed");
        document.getElementById("mainContent").classList.toggle("expanded");
    }

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
            window.location.href = "logout.php"; 
        });
</script>
<script>
        document.getElementById("notifBtn").addEventListener("click", () => {
            document.getElementById("notifOverlay").style.display = "block";
            document.getElementById("notifPanel").style.right = "0";
        });

        document.querySelector(".notif-close").addEventListener("click", () => {
            closeNotifPanel();
        });

        document.getElementById("notifOverlay").addEventListener("click", () => {
            closeNotifPanel();
        });

        function closeNotifPanel() {
            document.getElementById("notifOverlay").style.display = "none";
            document.getElementById("notifPanel").style.right = "-380px";
        }
</script>
</body>
</html>