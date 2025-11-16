<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA - Voting System</title>

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

        /* ---------------- NAVBAR FIXED ---------------- */
        .navbar {
            background-color: var(--beige-sidebar);
            padding: 0.8rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 2000;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--orange-primary);
            font-size: 1.4rem;
            font-weight: bold;
        }

        .logo-img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .search-bar {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .search-bar input {
            width: 380px;
            padding: 10px 18px;
            border-radius: 25px;
            border: 2px solid #ddd;
        }

        .search-bar input:focus {
            border-color: var(--orange-primary);
            outline: none;
        }

        .nav-icons {
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
            position: relative;
        }

        .icon-btn:hover {
            color: var(--orange-dark);
        }

        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #dc3545;
            color: white;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* ---------------- CONTENT ---------------- */
        .main-content {
            margin-left: 280px;
            margin-top: 80px;
            padding: 30px;
            flex: 1;
        }

        .vote-header {
            text-align: center;
            margin-bottom: 40px;
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
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="#" class="logo">
            <img src="img/logo.png" class="logo-img" alt="SISVORA Logo">
            <span>SISVORA</span>
        </a>

        <div class="search-bar">
            <input type="text" placeholder="🔍 Search...">
        </div>

        <div class="nav-icons">
            <button class="icon-btn">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            <button class="icon-btn"><i class="fas fa-question-circle"></i></button>
            <button class="icon-btn"><i class="fas fa-user-circle"></i></button>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="user-profile">
            <div class="user-avatar">👤</div>
            <div class="user-name">Jan Adam</div>
            <div class="user-status">Student, Unvoted</div>
        </div>

        <div class="menu">
            <div class="menu-item" onclick="go('dashboard')">🏠 Dashboard</div>
            <div class="menu-item active" onclick="go('vote')">🗳️ Vote</div>
            <div class="menu-item" onclick="go('guideline')">📋 Voters Guideline</div>
            <div class="menu-item" onclick="go('settings')">⚙️ Settings</div>
        </div>

        <div class="logout" onclick="logout()">🚪 Logout</div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="vote-header">
            <h1 class="vote-title">CAST YOUR VOTES NOW!</h1>
        </div>

        <!-- Example Candidate Section -->
        <div class="candidate-section">
            <h2>Candidate 01</h2>
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
    </script>

</body>
</html>
