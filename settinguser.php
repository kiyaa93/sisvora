

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA – Settings</title>
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

         /* ---------------- SIDEBAR ---------------- */
        .sidebar {
            position: fixed;
            left: 0;
            top: 80px;
            height: calc(100vh - 80px);
            width: 280px;
            background-color: var(--beige-sidebar);
            border-top: 1px solid rgba(0,0,0,0.08);
            border-top-right-radius: 50px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
            overflow-y: auto;
            z-index: 999;
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

        .logout {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #D94E28;
            cursor: pointer;
            margin-top: auto;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: var(--beige-bg);
            padding: 1rem 2rem;
            position: fixed;
            left: 0;
            width: 100%;
            display: flex;
            z-index: 2000;
            height: 80px;
        }

        .navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }

        .logo {
            font-size: 1.2rem;
            margin-left: 8px;
            font-weight: bold;
            color: #D2691E;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-img {
            height: 45px;
            object-fit: contain;
            transform: scale(1.5);
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
            border-color: #D2691E;
            box-shadow: 0 0 0 0.2rem rgba(210,105,30,0.25);
        }

        .icon-btn {
            background: none;
            border: none;
            color: #D2691E;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }
        .icon-btn:hover {
            color: #8B4513;
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

        /* SETTINGS PAGE CSS */

        .content-area {
            padding-left: 300px;
            padding-right: 40px;
            padding-top: 110px;
            transition: .3s;
        }

        @media (max-width: 768px) {
            .content-area {
                padding-left: 20px; 
            }
        }

        .page-title {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
        }

        .settings-list {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .settings-item {
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
        }

        .settings-item:hover {
            background: #fafafa;
        }

        .settings-icon {
            width: 40px;
            height: 40px;
            background: #FFE8DC;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D94E28;
            font-size: 18px;
        }

        .settings-label {
            font-weight: 500;
            color: #333;
        }

        .settings-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-switch {
            width: 50px;
            height: 26px;
            background: #D94E28;
            border-radius: 13px;
            position: relative;
            cursor: pointer;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            background: white;
            border-radius: 50%;
            top: 2px;
            right: 2px;
        }

        .toggle-switch.off {
            background: #ccc;
        }

        .toggle-switch.off::after {
            right: 26px;
        }

        /* MODAL */

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            padding-left: 0;
            z-index: 3000 !important;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            position: relative;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: scroll;
            z-index: 3100;
            scrollbar-width: none;
        }
        .modal-content::-webkit-scrollbar {
            display: none; /* Chrome, Safari */
        }

        .modal-title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            background: #8B5A3C;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 60px;
        }

        .photo-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            padding: 10px 25px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-upload {
            background: #D94E28;
            color: white;
        }

        .btn-remove {
            background: white;
            color: #D94E28;
            border: 2px solid #D94E28;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #FFB085;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .btn-save {
            background: #D94E28;
            color: white;
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            border-radius: 30px;
            border: none;
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

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="user-profile">
            <div class="user-avatar">👤</div>
            <div class="user-name">Jan Adam</div>
            <div class="user-status">Student, Unvoted</div>
        </div>

        <div class="menu">
            <div class="menu-item" onclick="go('dashboarduser')">🏠 Dashboard</div>
            <div class="menu-item" onclick="go('vote')">🗳️ Vote</div>
            <div class="menu-item" onclick="go('votersguad')">📋 Voters Guideline</div>
            <div class="menu-item active" onclick="go('settinguser')">⚙️ Settings</div>
        </div>

        <div class="logout" onclick="logout()">🚪 Logout</div>
    </div>

    <!-- MAIN CONTENT -->
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

        <!-- SETTINGS CONTENT -->
        <div class="content-area">
            <div class="settings-container">

                <h1 class="page-title">Settings</h1>

                <div class="settings-list">

                    <div class="settings-item" onclick="openEditProfile()">
                        <div class="settings-left" style="display: flex; align-items: center; gap: 15px;">
                            <div class="settings-icon">✏️</div>
                            <span class="settings-label">Edit Profile</span>
                        </div>
                        <span style="color: #D94E28;">›</span>
                    </div>

                    <div class="settings-item" onclick="changePassword()">
                        <div class="settings-left" style="display: flex; align-items: center; gap: 15px;">
                            <div class="settings-icon">🔑</div>
                            <span class="settings-label">Change Password</span>
                        </div>
                        <span style="color: #D94E28;">›</span>
                    </div>

                    <div class="settings-item" onclick="changeLanguage()">
                        <div class="settings-left" style="display: flex; align-items: center; gap: 15px;">
                            <div class="settings-icon">🌐</div>
                            <span class="settings-label">Language</span>
                        </div>
                        <div class="settings-right">
                            <span style="color: #D94E28;">English</span>
                            <span style="color: #D94E28;">›</span>
                        </div>
                    </div>

                    <div class="settings-item">
                        <div class="settings-left" style="display: flex; align-items: center; gap: 15px;">
                            <div class="settings-icon">🔔</div>
                            <span class="settings-label">Notification</span>
                        </div>
                        <div class="settings-right">
                            <div class="toggle-switch" onclick="toggleNotification(this)"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- MODAL EDIT PROFILE -->
    <div class="modal" id="editProfileModal">
        <div class="modal-content">

            <h2 class="modal-title">PROFILE</h2>

            <div class="profile-photo">👤</div>

            <div class="photo-buttons">
                <button class="btn btn-upload">UPLOAD</button>
                <button class="btn btn-remove">REMOVE</button>
            </div>

            <form id="profileForm">

                <div class="form-group">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-input" value="Jan">
                </div>

                <div class="form-group">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-input" value="Adam">
                </div>

                <div class="form-group">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">NIS</label>
                    <input type="text" class="form-input" value="012345678">
                </div>

                <div class="form-group">
                    <label class="form-label">Tempat, Tanggal Lahir</label>
                    <input type="text" class="form-input" value="Jakarta, 9 Februari 2004">
                </div>

                <div class="form-group">
                    <label class="form-label">No. Telp</label>
                    <input type="text" class="form-input" value="081222666435">
                </div>

                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-input" value="janadam092@gmail.com">
                </div>

                <button type="submit" class="btn-save">SAVE</button>

            </form>
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

        function openEditProfile() {
            document.getElementById("editProfileModal").classList.add("active");
        }

        function changePassword() {
            alert("Change Password feature coming soon!");
        }

        function changeLanguage() {
            alert("Language selection coming soon!");
        }

        function toggleNotification(el) {
            el.classList.toggle("off");
        }

        document.getElementById("editProfileModal").addEventListener("click", function(e) {
            if (e.target === this) {
                this.classList.remove("active");
            }
        });

        document.getElementById("profileForm").addEventListener("submit", function(e) {
            e.preventDefault();
            alert("Profile updated successfully!");
            document.getElementById("editProfileModal").classList.remove("active");
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
