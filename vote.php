<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA - Voting System</title>
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
            display: flex;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--beige-bg);
            padding: 1rem 2rem;
            position: fixed;
            left: 0;
            width: 100%;
            z-index: 2000;
        }

        .navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
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
            box-shadow: 0 0 0 0.2rem rgba(210,105,30,0.25);
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

        /* PANEL CONTENT */
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
        
        /* ---------------- SIDEBAR ---------------- */
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
            overflow-y: auto;
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
            border-left: 4px solid #B83D1F;
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
        
        .menu-separator {
            margin: 1rem 1.5rem;
            border-top: 1px solid rgba(210, 105, 30, 0.2);
        }

        /* ---------------- CONTENT ---------------- */        
        .content-area {
            margin-left: 280px;
            padding-top: 80px;
            padding: 2.3rem;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 76px);
            position: relative;
            flex: 1;
            width: 100%;
        }

        .content-area.expanded {
            margin-left: 0;
        }

        .vote-header {
            margin-bottom: 40px;
            margin-top: 60px;
        }
        .vote-title {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #D2691E;
        }

        .candidate-header {
            text-align: center;
        }

        .candidate-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 30px;
        }

        .candidate-card {
            background: linear-gradient(135deg, #FFE8DC 0%, #FFD4B8 100%);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
        }

        .candidate-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #8B5A3C;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 60px;
            margin: 0 auto 20px;
        }

        .btn-vote {
            background: #D94E28;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
        }

        /* ---------------- MODAL ---------------- */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 3000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            position: relative;
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

            <div class="search-bar d-none d-md-block">
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

    <!-- SIDEBAR -->
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
            <div class="menu-item active" onclick="go('vote')">
                <i class="fas fa-vote-yea"></i>
                <span>Vote</span>
            </div>
            <div class="menu-item" onclick="go('votersguad')">
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
            </a>
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

    <!-- MAIN CONTENT -->
    <div class="content-area" id="mainContent">

        <div class="vote-header">
            <h1 class="vote-title">CAST YOUR VOTES NOW!</h1>
        </div>

            <!-- Example Candidate Section -->
            <div class="candidate-section">
                <div class="candidate-header">
                    <h2>Candidate 01</h2>
                    <p>You can only vote for one candidate</p>
                </div>

                <div class="candidates-grid">
                    <div class="candidate-card">
                        <div class="candidate-photo">👨‍💼</div>
                        <div class="candidate-name">Malik Chandra Wirata</div>
                        <div class="candidate-position">for PRESIDENT STUDENT COUNCIL</div>
                        <button class="btn-vote" onclick="showVoteAlert('Malik Chandra')">VOTE</button>
                    </div>

                    <div class="candidate-card">
                        <div class="candidate-photo">👩‍💼</div>
                        <div class="candidate-name">Milania Rifa</div>
                        <div class="candidate-position">for VICE PRESIDENT STUDENT COUNCIL</div>
                        <button class="btn-vote" onclick="showVoteAlert('Milania Rifa')">VOTE</button>
                    </div>
                </div>
            </div>    

            <!-- Candidate 02 -->
            <div class="candidate-section">
                <div class="candidate-header">
                    <h2>Candidate 02</h2>
                    <p>You can only vote for one candidate</p>
                </div>

                <div class="candidates-grid">
                    <div class="candidate-card">
                        <div class="candidate-photo">👨‍💼</div>
                        <div class="candidate-name">Mahendra Yosa</div>
                        <div class="candidate-position">for PRESIDENT STUDENT COUNCIL</div>
                        <button class="btn-vote" onclick="showVoteAlert('Mahendra Yosa')">VOTE</button>
                    </div>

                    <div class="candidate-card">
                        <div class="candidate-photo">👩‍💼</div>
                        <div class="candidate-name">Jemima Saghi Larissa</div>
                        <div class="candidate-position">for VICE PRESIDENT STUDENT COUNCIL</div>
                        <button class="btn-vote" onclick="showVoteAlert('Jemima Saghi Larissa')">VOTE</button>
                    </div>
                </div>
            </div>

            <!-- Candidate 03 -->
            <div class="candidate-section">
                <div class="candidate-header">
                    <h2>Candidate 03</h2>
                    <p>You can only vote for one candidate</p>
                </div>

                <div class="candidates-grid">
                    <div class="candidate-card">
                        <div class="candidate-photo">👨‍💼</div>
                        <div class="candidate-name">Prashiya Ghilar Saputra</div>
                        <div class="candidate-position">for PRESIDENT STUDENT COUNCIL</div>
                        <button class="btn-vote" onclick="showVoteAlert('Prashiya Ghilar Saputr')">VOTE</button>
                    </div>

                    <div class="candidate-card">
                        <div class="candidate-photo">👩‍💼</div>
                        <div class="candidate-name">Kamiya Hanumi</div>
                        <div class="candidate-position">for VICE PRESIDENT STUDENT COUNCIL</div>
                        <button class="btn-vote" onclick="showVoteAlert('Kamiya Hanumi')">VOTE</button>
                    </div>
                </div>
            </div>  
    </div>

    <!-- MODAL -->
    <div id="alert" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeAlert()">✖</span>
            <h3 class="modal-title">Confirm Your Vote</h3>
            <p id="alert-text"></p>
            <button class="btn-modal-vote" onclick="confirmVote()">Confirm</button>
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

        function showVoteAlert(name) {
            document.getElementById("alert-text").innerText =
                "Are you sure you want to vote for " + name + "?";
            document.getElementById("alert").classList.add("active");
        }

        function closeAlert() {
            document.getElementById("alert").classList.remove("active");
        }

        function confirmVote() {
            closeAlert();
            alert("Your vote has been submitted!");
        }

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
