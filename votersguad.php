<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA – Voters Guideline</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .sidebar-wrapper {
            position: fixed;
            left: 0;
            top: 80px;
            height: 100vh;
            width: 280px;
            background-color: var(--beige-sidebar);
            border-top: 1px solid rgba(0,0,0,0.08);
            border-top-right-radius: 50px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            z-index: 999;
            overflow-y: auto;
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

        .user-name {
            font-weight: bold;
            font-size: 1.3rem;
            color: var(--orange-dark);
            margin-bottom: 0.3rem;
        }

        .user-status {
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

        .menu-item:hover {
            background-color: rgba(210, 105, 30, 0.1);
            color: var(--orange-primary);
            border-left-color: var(--orange-primary);
        }

        .menu-item.active {
            background: #D94E28;
            color: white;
            border-left-color: var(--orange-dark);
        }

        .menu-item i {
            text-align: center;
            font-size: 1.2rem;
            width: 24px;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-separator {
            margin: 1rem 1.5rem;
            border-top: 1px solid rgba(210, 105, 30, 0.2);
        }

         /* Navbar Styles */
        .navbar {
            background-color: var(--beige-bg);
            padding: 1rem 2rem;
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
              
        .navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }
        
        .navbar .logo {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--orange-primary);
            display: flex;
            margin-left: 8px;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }

        .logo-img {
            height: 45px;
            width: auto;
            object-fit: contain;
            transform: scale(1.5);
        }

        .navbar .search-bar {
            flex-grow: 1;
            max-width: 600px;
        }

        .navbar .search-bar input {
            border-radius: 25px;
            padding: 0.6rem 1.5rem;
            border: 2px solid #ddd;
        }

        .navbar .search-bar input:focus {
            border-color: var(--orange-primary);
            box-shadow: 0 0 0 0.15rem rgba(210,105,30,0.25);
        }

        .icon-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--orange-primary);
            transition: all 0.3s;
            position: relative; /* <= WAJIB */
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

        .content-area {
            margin-left: 280px;
            padding: 2.3rem;
            padding-top: 80px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 76px);
            position: relative;
            z-index: 1;
        }

        .content-area.expanded {
            margin-left: 0;
        }

        /* --- GUIDELINE PAGE CSS --- */
        .guideline-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .guideline-list {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .guideline-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
        }

        .guideline-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: flex-start;
        }

        .guideline-number {
            width: 35px;
            height: 35px;
            background: #FFE8DC;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D94E28;
            font-weight: 600;
        }

        .guideline-text {
            color: #333;
            line-height: 1.6;
        }

        .guideline-illustration {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 200px;
            opacity: 0.3;
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

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .sidebar {
                transform: translateX(-280px);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
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
                    <button class="icon-btn" id="notifBtn" title="Notifications" >
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
            <div class="user-name">Jan Adam</div>
            <div class="user-status">Student, Unvoted</div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-item" onclick="go('dashboarduser')">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </div>
            <div class="menu-item" onclick="go('vote')">
                <i class="fas fa-vote-yea"></i>
                <span>Vote</span>
            </div>
            <div class="menu-item active" onclick="go('votersguad')">
                <i class="fas fa-list-alt"></i>
                <span>Voters Guideline</span>
            </div>
            <div class="menu-item" onclick="go('settinguser')">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </div>
            <div class="menu-separator"></div>
            <a href="#" id="logoutMenu" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </div>
        </div>
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-area" id="mainContent">
            <div class="guideline-container">

                <div class="guideline-list">
                    <h1 class="guideline-title">Voters Guideline</h1>

                    <div class="guideline-item">
                        <div class="guideline-number">
                            1
                        </div>
                        <div class="guideline-text">
                            Before voting, take the time to research the candidates and issues on the ballot.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            2
                        </div>
                        <div class="guideline-text">
                            Make sure you are eligible to vote in the election.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            3
                        </div>
                        <div class="guideline-text">
                            Understand the voting procedure for the online system.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            4
                        </div>
                        <div class="guideline-text">
                            Read the instructions carefully before voting.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            5
                        </div>
                        <div class="guideline-text">
                            Make sure you understand the candidates and their positions.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            6
                        </div>
                        <div class="guideline-text">
                            Choose your candidate carefully based on your research.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            7
                        </div>
                        <div class="guideline-text">
                            If unsure how to vote, ask a trusted friend or relative.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            8
                        </div><div class="guideline-text">
                            Double check your choices before submitting your vote.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            9
                        </div>
                        <div class="guideline-text">
                            Ensure your internet connection is secure when voting.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            10
                        </div>
                        <div class="guideline-text">
                            Keep your vote private. Do not share it with anyone.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            11
                        </div>
                        <div class="guideline-text">
                            Understand the voting deadlines.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            12
                        </div>
                        <div class="guideline-text">
                            Follow all instructions from the election committee.
                        </div>
                    </div>
                    <div class="guideline-item">
                        <div class="guideline-number">
                            13
                        </div>
                        <div class="guideline-text">
                            Report any issues or concerns about the voting process.
                        </div>
                    </div>
                </div>

                <div class="guideline-illustration">
                    <img src="img/v3.png" alt="Guideline Illustration">
                </div>
            </div>
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

    <script>
        function go(page) {
            window.location.href = page + ".php";
        }

        
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
