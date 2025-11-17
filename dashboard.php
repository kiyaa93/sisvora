<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVORA - Dashboard Admin</title>
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
        
        /* Navbar Styles */
        .navbar {
            background-color: var(--beige-sidebar);
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
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
            top: 76px;
            height: calc(100vh - 76px);
            width: 280px;
            background-color: var(--beige-sidebar);
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
        
        .user-profile h5 {
            color: var(--orange-dark);
            font-weight: bold;
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
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 76px);
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        .welcome-text {
            margin-bottom: 2rem;
        }
        
        .welcome-text h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .welcome-text h2 strong {
            color: var(--orange-primary);
        }
        
        .welcome-text p {
            color: #666;
            font-size: 1.1rem;
        }
        
        .section-title {
            color: var(--orange-dark);
            font-weight: bold;
            margin: 2rem 0 1rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-title i {
            color: var(--orange-primary);
        }
        
        /* Voting Card */
        .voting-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .voting-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }
        
        .voting-card h3 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--orange-dark);
        }
        
        .status-badge {
            background-color: var(--orange-primary);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            animation: glow 2s ease-in-out infinite;
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(210, 105, 30, 0.5); }
            50% { box-shadow: 0 0 20px rgba(210, 105, 30, 0.8); }
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-circle {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--orange-primary);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .stat-label {
            margin-top: 1rem;
            color: #666;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .stat-sublabel {
            color: #999;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }
        
        /* Results Card */
        .results-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .results-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }
        
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .results-header h4 {
            color: var(--orange-dark);
            margin: 0;
        }
        
        .chart-controls button {
            background-color: white;
            border: 2px solid var(--orange-primary);
            color: var(--orange-primary);
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            margin: 0 0.3rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .chart-controls button:hover {
            background-color: var(--orange-primary);
            color: white;
        }
        
        .chart-controls span {
            margin: 0 1rem;
            font-weight: 500;
            color: var(--orange-dark);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(210, 105, 30, 0.3);
            border-radius: 50%;
            border-top-color: var(--orange-primary);
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
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
                <button class="icon-btn" title="Notifications">
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
            <h5>Admin_ID</h5>
            <p class="text-muted">Administrator</p>
        </div>

        <nav class="sidebar-menu">
            <a href="dashboard.php" class="menu-item active"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <a href="voters-data.php" class="menu-item"><i class="fas fa-users"></i><span>Voters Data</span></a>
            <a href="candidate-data.php" class="menu-item"><i class="fas fa-user-tie"></i><span>Candidate Data</span></a>
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

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="welcome-text">
            <h2>Hello, <strong>Admin!</strong></h2>
            <p>Welcome Back to SISVORA Management Panel.</p>
        </div>

        <h4 class="section-title">
            <i class="fas fa-chart-line"></i>
            Voting Progress
        </h4>

        <!-- Voting Stats Card -->
        <div class="voting-card">
            <h3>President Student Council 2025/2026</h3>
            <div class="text-center mb-3">
                <span>Status: </span>
                <span class="status-badge" id="statusBadge">
                    <i class="fas fa-spinner fa-spin loading" style="display:none;" id="statusLoading"></i>
                    <span id="statusText">Loading...</span>
                </span>
            </div>

            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-circle">
                        <canvas id="candidatesChart"></canvas>
                        <div class="stat-number" id="totalCandidates">0</div>
                    </div>
                    <div class="stat-label">Total number of<br>registered candidates</div>
                    <div class="stat-sublabel"><i class="fas fa-user-tie"></i> Candidates</div>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <canvas id="votersChart"></canvas>
                        <div class="stat-number" id="totalVoters">0</div>
                    </div>
                    <div class="stat-label">Total number of<br>registered voters</div>
                    <div class="stat-sublabel"><i class="fas fa-users"></i> Voters</div>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <canvas id="votedChart"></canvas>
                        <div class="stat-number" id="totalVoted">0</div>
                    </div>
                    <div class="stat-label">Total number of<br>already voted</div>
                    <div class="stat-sublabel"><i class="fas fa-check-circle"></i> Voted</div>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <canvas id="notVotedChart"></canvas>
                        <div class="stat-number" id="totalNotVoted">0</div>
                    </div>
                    <div class="stat-label">Total number of<br>haven't voted yet</div>
                    <div class="stat-sublabel"><i class="fas fa-clock"></i> Pending</div>
                </div>
            </div>
        </div>

        <!-- Live Results Card -->
        <div class="results-card">
            <div class="results-header">
                <h4><i class="fas fa-poll"></i> Live Results</h4>
                <div class="chart-controls">
                    <button onclick="previousElection()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span id="electionTitle">President Student Council</span>
                    <button onclick="nextElection()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="resultsChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // API Configuration
        const API_URL = 'dashboard-data.php'; // Ganti dengan URL API Anda
        const REFRESH_INTERVAL = 5000; // 5 detik

        // Chart instances
        let circleCharts = {};
        let resultsChart = null;

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

        // Sidebar Toggle
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("mainContent").classList.toggle("expanded");
        }

        // Election Navigation
        function previousElection() {
            console.log('Previous election');
            alert('Previous election feature coming soon!');
        }

        function nextElection() {
            console.log('Next election');
            alert('Next election feature coming soon!');
        }

        // Initialize circular progress charts
        function createCircleChart(canvasId, value, total, color) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            const percentage = total > 0 ? (value / total) * 100 : 0;
            
            if (circleCharts[canvasId]) {
                circleCharts[canvasId].destroy();
            }
            
            circleCharts[canvasId] = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [value, Math.max(0, total - value)],
                        backgroundColor: [color, '#f0f0f0'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        }

        // Initialize results bar chart
        function createResultsChart(data) {
            const ctx = document.getElementById('resultsChart').getContext('2d');
            
            if (resultsChart) {
                resultsChart.destroy();
            }
            
            const labels = data.map(item => item.name);
            const votes = data.map(item => item.votes);
            const colors = ['#D2691E', '#CD853F', '#8B4513'];
            
            resultsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Votes (%)',
                        data: votes,
                        backgroundColor: colors,
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.x.toFixed(2) + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }

        // Fetch dashboard data
        async function fetchDashboardData() {
            try {
                const response = await fetch(API_URL);
                const data = await response.json();
                
                if (data.success) {
                    updateDashboard(data.data);
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Update dashboard with new data
        function updateDashboard(data) {
            // Update status
            document.getElementById('statusText').textContent = data.status;
            document.getElementById('statusBadge').classList.remove('loading');
            
            // Update numbers with animation
            animateNumber('totalCandidates', data.totalCandidates);
            animateNumber('totalVoters', data.totalVoters);
            animateNumber('totalVoted', data.totalVoted);
            animateNumber('totalNotVoted', data.totalNotVoted);
            
            // Update circle charts
            createCircleChart('candidatesChart', data.totalCandidates, data.totalCandidates, '#D2691E');
            createCircleChart('votersChart', data.totalVoters, data.totalVoters, '#D2691E');
            createCircleChart('votedChart', data.totalVoted, data.totalVoters, '#D2691E');
            createCircleChart('notVotedChart', data.totalNotVoted, data.totalVoters, '#F4A460');
            
            // Update results chart
            if (data.results && data.results.length > 0) {
                createResultsChart(data.results);
            }
        }

        // Animate number counting
        function animateNumber(elementId, targetValue) {
            const element = document.getElementById(elementId);
            const currentValue = parseInt(element.textContent) || 0;
            const increment = (targetValue - currentValue) / 20;
            let current = currentValue;
            
            const timer = setInterval(() => {
                current += increment;
                if ((increment > 0 && current >= targetValue) || (increment < 0 && current <= targetValue)) {
                    element.textContent = targetValue;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.round(current);
                }
            }, 50);
        }

        // Initialize with sample data
        function initializeDashboard() {
            const sampleData = {
                status: 'Ongoing',
                totalCandidates: 3,
                totalVoters: 674,
                totalVoted: 567,
                totalNotVoted: 107,
                results: [
                    { name: 'Candidate 01', votes: 45 },
                    { name: 'Candidate 02', votes: 35 },
                    { name: 'Candidate 03', votes: 20 }
                ]
            };
            
            updateDashboard(sampleData);
        }

        // Start real-time updates
        function startRealTimeUpdates() {
            setInterval(fetchDashboardData, REFRESH_INTERVAL);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeDashboard();
            
            // Uncomment untuk enable real-time updates
            // startRealTimeUpdates();
            
            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.querySelector('.toggle-sidebar-btn');
                
                if (window.innerWidth <= 768 && 
                    !sidebar.contains(event.target) && 
                    !toggleBtn.contains(event.target) &&
                    sidebar.classList.contains('show')) {
                    toggleSidebar();
                }
            });
        });
    </script>
</body>
</html>