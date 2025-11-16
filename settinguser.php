

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA – Settings</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #FFD4B8 0%, #FFB085 100%);
            padding: 20px 0;
            display: flex;
            flex-direction: column;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px 30px;
            color: #D94E28;
            font-weight: bold;
            font-size: 20px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .user-profile {
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: #8B5A3C;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
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

        .menu-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #8B5A3C;
            cursor: pointer;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.3);
        }

        .menu-item.active {
            background: #D94E28;
            color: white;
            border-left: 4px solid #B83D1F;
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

        .top-bar {
            background: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .search-bar {
            flex: 1;
            max-width: 400px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .top-icons {
            display: flex;
            gap: 15px;
            margin-left: auto;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            background: #FFB085;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .content-area {
            padding: 30px;
            flex: 1;
        }

        /* SETTINGS PAGE CSS */

        .settings-container {
            max-width: 1200px;
            margin: 0 auto;
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
            z-index: 1000;
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
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
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
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-icon">📊</div>
            <span>SISVORA</span>
        </div>

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

        <!-- TOP BAR -->
        <div class="top-bar">
            <div class="menu-toggle">☰</div>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <span class="search-icon">🔍</span>
            </div>
            <div class="top-icons">
                <div class="icon-btn">🔔</div>
                <div class="icon-btn">❓</div>
                <div class="icon-btn">👤</div>
            </div>
        </div>

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
    </script>

</body>
</html>
