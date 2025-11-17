<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --orange-primary: #D2691E;
            --orange-light: #F4A460;
            --orange-dark: #8B4513;
            --beige-bg: #F5E6D3;
            --beige-sidebar: #E8D4BF;

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
            height: calc(100vh - 76px);
            width: 280px;
            background-color: var(--beige-sidebar);
            border-top: 1px solid rgba(0,0,0,0.08);
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
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #D94E28;
            cursor: pointer;
            margin-top: auto;
        }

        .logout:hover {
            background: rgba(217, 78, 40, 0.1);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--beige-sidebar);
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            left: 0;
            width: 100%;
            z-index: 2000;
        }
        
        .navbar .logo {
            font-size: 1.5rem;
            margin-left: 8px;
            font-weight: bold;
            color: var(--orange-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-img {
            height: 45px;   /* sesuaikan */
            width: auto;
            object-fit: contain;
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

        .content-area {
            margin-left: 280px;
            padding: 2rem;
            padding-top: 110px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 76px);
        }

        .content-area.expanded {
            margin-left: 0;
        }

        .welcome-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .greeting h2 {
            font-size: 28px;
            color: #333;
        }

        .greeting p {
            color: #666;
            margin-top: 5px;
        }

        .timer {
            background: #FF9D5C;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .election-card {
            background: linear-gradient(135deg, #FFE8DC 0%, #FFD4B8 100%);
            border-radius: 15px;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .election-info h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
        }

        .btn-vote {
            background: white;
            color: #D94E28;
            padding: 12px 30px;
            border-radius: 25px;
            border: 2px solid #D94E28;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-vote:hover {
            background: #D94E28;
            color: white;
            transform: scale(1.05);
        }

        .election-illustration {
            font-size: 80px;
        }

        .election-illustration img {
            width: 100%;
            max-width: 180px; 
            display: block;
            margin: 0 auto;
        }

        .voting-progress {
            margin-top: 30px;
        }

        .voting-progress h3 {
            color: #333;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 10px solid #D94E28;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            font-weight: bold;
            color: #D94E28;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
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
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-profile">
            <div class="avatar"><i class="fas fa-user"></i></div>
            <div class="user-name">Jan Adam</div>
            <div class="user-status">Student, Unvoted</div>
        </div>

        <div class="menu">
            <div class="menu-item active" onclick="go('dashboarduser')">
                <span class="menu-icon">🏠</span>
                <span>Dashboard</span>
            </div>
            <div class="menu-item" onclick="go('vote')">
                <span class="menu-icon">🗳</span>
                <span>Vote</span>
            </div>
            <div class="menu-item" onclick="go('votersguad')">
                <span class="menu-icon">📋</span>
                <span>Voters Guideline</span>
            </div>
            <div class="menu-item" onclick="go('settinguser')">
                <span class="menu-icon">⚙</span>
                <span>Settings</span>
            </div>
        </div>

        <div class="logout" onclick="logout()">
            <span class="menu-icon">🚪</span>
            <span>Logout</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <nav class="navbar">
            <div class="container-fluid">
                <button class="btn d-md-none me-2" type="button" onclick="toggleSidebar()">
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

        <!-- Dashboard Page Content -->
        <div class="content-area">

            <div class="welcome-section">
                <div class="welcome-header">
                    <div class="greeting">
                        <h2>Hello, <strong>Jan!</strong></h2>
                        <p>Welcome to SISVORA Online Voting System.</p>
                    </div>
                    <div class="timer">
                        ⏰ <span id="timer">01:20:42</span>
                    </div>
                </div>

                <div class="election-card">
                    <div class="election-info">
                        <p style="color: #D94E28; font-weight: 600; margin-bottom: 10px;">Ongoing Elections</p>
                        <h3>President Student Council<br>2025/2026</h3>
                        <button class="btn-vote">Vote Now</button>
                    </div>
                    <div class="election-illustration">
                        <img src="img/v1.png" alt="Election Illustration">
                    </div>
                </div>

                <div class="voting-progress">
                    <h3>Voting Progress</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-circle">3</div>
                            <div class="stat-label">Total number of<br>registered candidates</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-circle">674</div>
                            <div class="stat-label">Total number of<br>registered voters</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-circle">587</div>
                            <div class="stat-label">Total number of<br>vote</div>
                        </div>
                    </div>
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

        // Timer countdown
        function updateTimer() {
            const timerEl = document.getElementById('timer');
            let [hours, minutes, seconds] = timerEl.textContent.split(':').map(Number);
            
            if (seconds > 0) {
                seconds--;
            } else if (minutes > 0) {
                minutes--;
                seconds = 59;
            } else if (hours > 0) {
                hours--;
                minutes = 59;
                seconds = 59;
            }
            
            timerEl.textContent = 
                ${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')};
        }
        
        setInterval(updateTimer, 1000);

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logged out successfully!');
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