<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA – Voters Guideline</title>

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
            <div class="menu-item active" onclick="go('votersguad')">📋 Voters Guideline</div>
            <div class="menu-item" onclick="go('settinguser')">⚙️ Settings</div>
        </div>

        <div class="logout" onclick="logout()">🚪 Logout</div>
    </div>

    <!-- Main Content -->
    <div class="main-content">

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

                <div class="guideline-illustration">✅</div>
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
    </script>

</body>
</html>
