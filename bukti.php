<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Suara - Sisvora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></style>
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
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--beige-bg) ;
            overflow-x: hidden;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--beige-bg);
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
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
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--orange-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .logo-img {
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
            top: 75px;
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
            color: var(--orange-dark);
            font-weight: bold;
            font-size: 1.3rem;
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

        .main-content {
            margin-left: clamp(280px, 25vw, 360px);
            margin-top: clamp(80px, 15vh, 150px);
            padding: clamp(20px, 3vw, 38px);
        }

        .proof-container {
            width: min(682px, 100%);
            margin: 0 auto;
            animation: fadeIn 0.6s ease-out;
        }

        .proof-header {
            background-color: #e5641f;
            border: 1px solid #d9d9d9;
            border-radius: clamp(20px, 2.5vw, 30px) clamp(20px, 2.5vw, 30px) 0 0;
            padding: clamp(20px, 3vh, 24px) clamp(20px, 3vw, 40px) clamp(25px, 3.5vh, 30px);
            text-align: center;
        }

        .proof-icon {
            width: clamp(40px, 6vw, 50px);
            height: clamp(40px, 6vw, 50px);
            margin: 0 auto clamp(6px, 1vh, 8px);
        }

        .proof-header-title {
            font-size: clamp(20px, 2.2vw, 24px);
            font-weight: 700;
            color: white;
            margin-bottom: clamp(3px, 0.5vh, 4px);
        }

        .proof-header-subtitle {
            font-size: clamp(16px, 1.8vw, 20px);
            font-weight: 600;
            color: white;
        }

        .proof-body {
            background-color: #fbf7f1;
            border: 1px solid #d9d9d9;
            border-top: none;
            padding: clamp(30px, 4vh, 46px) clamp(20px, 3vw, 35px);
        }

        .proof-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: clamp(20px, 3vh, 30px);
            flex-wrap: wrap;
            gap: 10px;
        }

        .proof-label {
            font-size: clamp(18px, 2vw, 24px);
            font-weight: 600;
            color: #b03d00;
        }

        .proof-value {
            font-size: clamp(18px, 2vw, 24px);
            font-weight: 600;
            color: rgba(0, 0, 0, 0.6);
            text-align: right;
        }

        .proof-divider {
            border: none;
            border-top: 1px solid #fdbc86;
            margin: clamp(30px, 4vh, 46px) 0;
        }

        .proof-status-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: clamp(15px, 2vh, 20px);
            flex-wrap: wrap;
            gap: 10px;
        }

        .proof-status-verified {
            font-size: clamp(18px, 2vw, 24px);
            color: darkorange;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .proof-code-box {
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            padding: clamp(15px, 2vh, 20px);
            text-align: center;
            margin-bottom: clamp(20px, 3vh, 30px);
        }

        .proof-code-label {
            font-size: clamp(16px, 1.8vw, 20px);
            color: #000;
            margin-bottom: clamp(6px, 1vh, 8px);
        }

        .proof-code-value {
            font-family: 'Cascadia Mono', 'Courier New', monospace;
            font-size: clamp(20px, 2.5vw, 27px);
            color: #000;
            letter-spacing: 2px;
            word-break: break-all;
        }

        .proof-footer {
            background-color: rgba(246, 212, 183, 0.3);
            border: 1px solid #d9d9d9;
            border-top: none;
            border-radius: 0 0 clamp(20px, 2.5vw, 30px) clamp(20px, 2.5vw, 30px);
            padding: clamp(20px, 3vh, 27px) clamp(20px, 3vw, 40px) clamp(30px, 4vh, 45px);
            text-align: center;
        }

        .proof-footer-text {
            font-size: clamp(16px, 1.8vw, 20px);
            color: #000;
            margin-bottom: clamp(20px, 3vh, 25px);
            line-height: 1.6;
        }

        .proof-footer-text strong {
            font-weight: 600;
        }

        .btn {
            padding: clamp(10px, 1.2vh, 12px) clamp(20px, 2.5vw, 30px);
            border-radius: 50px;
            font-size: clamp(16px, 1.6vw, 20px);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #b03d00;
            color: white;
            min-width: clamp(150px, 20vw, 200px);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .search-bar {
                display: none;
            }

            .proof-footer-text br {
                display: none;
            }
        }

        @media print {
            header,
            .sidebar,
            .btn {
                display: none;
            }

            .main-content {
                margin: 0;
                padding: 0;
            }

            .proof-container {
                box-shadow: none;
            }
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

    <main class="main-content">
        <div class="proof-container">
            <div class="proof-header">
                <div class="proof-icon">
                    <svg viewBox="0 0 50 50" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 4.16666H37.5C39.5833 4.16666 41.6667 6.24999 41.6667 8.33332V27.0833L29.1667 35.4167L16.6667 27.0833V8.33332C16.6667 6.24999 18.75 4.16666 20.8333 4.16666H12.5ZM25 20.8333C27.0833 20.8333 29.1667 18.75 29.1667 16.6667C29.1667 14.5833 27.0833 12.5 25 12.5C22.9167 12.5 20.8333 14.5833 20.8333 16.6667C20.8333 18.75 22.9167 20.8333 25 20.8333ZM29.1667 45.8333L25 43.75L20.8333 45.8333V35.4167L25 37.5L29.1667 35.4167V45.8333Z" fill="white"/>
                    </svg>
                </div>
                <div class="proof-header-title">Bukti Suara</div>
                <div class="proof-header-subtitle">President Student Council 2025/2026</div>
            </div>
            
            <div class="proof-body">
                <div class="proof-row">
                    <span class="proof-label">Voter Name</span>
                    <span class="proof-value">Jan Adam</span>
                </div>
                <div class="proof-row">
                    <span class="proof-label">Voter ID</span>
                    <span class="proof-value">VP-2025-10234</span>
                </div>
                <div class="proof-row">
                    <span class="proof-label">DATE, TIME</span>
                    <span class="proof-value">03 Nov 2025, 14:35 WIB</span>
                </div>
                
                <hr class="proof-divider">
                
                <div class="proof-status-header">
                    <span class="proof-label">STATUS</span>
                    <span class="proof-status-verified">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="#FF8C00"/>
                        </svg>
                        Terverifikasi
                    </span>
                </div>
                <div class="proof-code-box">
                    <div class="proof-code-label">Kode Verifikasi</div>
                    <div class="proof-code-value">XAT7-Z5TS-9GNB</div>
                </div>
            </div>
            
            <div class="proof-footer">
                <p class="proof-footer-text">
                    <strong>Terima kasih telah berpartisipasi!</strong><br>
                    Simpan bukti ini sebagai tanda Anda telah melakukan voting.<br>
                    Kode verifikasi dapat digunakan untuk mengecek status voting.
                </p>
                <button class="btn btn-primary" onclick="window.print()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19 8H5C3.34 8 2 9.34 2 11V17H6V21H18V17H22V11C22 9.34 20.66 8 19 8ZM16 19H8V14H16V19ZM19 12C18.45 12 18 11.55 18 11C18 10.45 18.45 10 19 10C19.55 10 20 10.45 20 11C20 11.55 19.55 12 19 12ZM18 3H6V7H18V3Z" fill="white"/>
                    </svg>
                    CETAK BUKTI
                </button>
            </div>
        </div>
    </main>

    <script>
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
</body>
</html>
