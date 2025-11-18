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
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
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

        .sidebar.collapsed {
            transform: translateX(-280px);
        }

        .user-profile {
            text-align: center;
            padding: 2rem 1rem;
            background: linear-gradient(135deg, rgba(210, 105, 30, 0.1), rgba(244, 164, 96, 0.1));
            border-bottom: 2px solid rgba(210, 105, 30, 0.2);
        }

        .user-avatar {
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
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .user-status {
            color: #666;
            font-size: 14px;
        }

        .menu {
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

        .menu-icon {
            font-size: 20px;
            width: 24px;
        }

        .logout {
            margin-top: auto;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #D94E28;
            cursor: pointer;
        }

        .logout:hover {
            background: rgba(217,78,40,0.1);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

         /* Navbar Styles */
        .navbar {
            background-color: var(--beige-bg);
            padding: 1.1rem 2rem;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
                
        .logo {
            display: flex;
            margin-left: 12px;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }

        .logo-img {
            height: 40px;
            width: auto;
            object-fit: contain;
            transform: scale(1.5);
        }

        .logo span {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--orange-primary);
        }

        .search-bar {
            flex-grow: 1;
            max-width: 650px;
            margin: 0 40px;
        }

        .search-bar input {
            border-radius: 25px;
            padding: 0.6rem 1.2rem;
            border: 2px solid #ddd;
            width: 100%;
            background: #fff;
            font-size: 0.95rem;
        }

        .search-bar input:focus {
            border-color: var(--orange-primary);
            box-shadow: 0 0 0 0.15rem rgba(210,105,30,0.25);
        }
            
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--orange-primary);
            transition: 0.25s ease;
            position: relative; /* <= WAJIB */
        }

        .icon-btn:hover {
            color: var(--orange-dark);
            transform: scale(1.08);
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
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
        }

        .content-area.expanded {
            margin-left: 0;
        }

        /* --- GUIDELINE PAGE CSS --- */

        .guideline-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .guideline-list {
            background: white;
            border-radius: 15px;
            padding: 30px;
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
            .guideline-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-profile">
            <div class="user-avatar">👤</div>
            <div class="user-name">Jan Adam</div>
            <div class="user-status">Student, Unvoted</div>
        </div>

        <div class="menu">
            <div class="menu-item" onclick="go('dashboarduser')">🏠 Dashboard</div>
            <div class="menu-item" onclick="go('vote')">🗳️ Vote</div>
            <div class="menu-item active" onclick="go('votersguad')">📋 Voters Guideline</div>
            <div class="menu-item" onclick="go('settinguser')">⚙️ Settings</div>
        </div>

        <div class="logout" onclick="logout()">🚪 Logout</div>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <nav class="navbar">
    
    <div class="navbar-left">
        <button class="btn d-md-none me-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <a href="#" class="logo">
            <img src="img/logo.png" class="logo-img" alt="SISVORA Logo">
            <span>SISVORA</span>
        </a>
    </div>

    <div class="search-bar d-none d-md-block">
        <input type="search" placeholder="🔍 Search...">
    </div>

    <div class="navbar-right">
        <button class="icon-btn" id="notifBtn">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
        </button>

        <button class="icon-btn">
            <i class="fas fa-question-circle"></i>
        </button>

        <button class="icon-btn">
            <i class="fas fa-user-circle"></i>
        </button>
    </div>

</nav>

        <div class="content-area">
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

        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                alert("Logged out successfully!");
            }
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
