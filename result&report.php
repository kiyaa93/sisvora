<?php
include 'config.php';

// Ambil data election settings
$electionQuery = mysqli_query($conn, "SELECT * FROM elections_admin LIMIT 1");
$election = mysqli_fetch_assoc($electionQuery);

// Hitung status
$current = strtotime("now");
$start = strtotime($election['start_time']);
$end = strtotime($election['end_time']);

if($current < $start){
    $electionStatus = "Upcoming";
} elseif($current >= $start && $current <= $end){
    $electionStatus = "Ongoing";
} else {
    $electionStatus = "Finish";
}

// Ambil total voters
$votersQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM voters_admin");
$totalVoters = mysqli_fetch_assoc($votersQuery)['total'];

// Ambil yang sudah vote
$votedQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM voters_admin WHERE status = 'Voted'");
$totalVoted = mysqli_fetch_assoc($votedQuery)['total'];

// Ambil total participants (yang datang/hadir)
$participantsQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM voters_admin WHERE status IN ('Voted', 'Not Voted')");
$totalParticipants = mysqli_fetch_assoc($participantsQuery)['total'];

$totalNotVoted = $totalVoted > 0 ? $totalParticipants - $totalVoted : 0;

// Hitung persentase
$votedPercentage = $totalVoters > 0 ? round(($totalVoted / $totalVoters) * 100) : 0;
$notVotedPercentage = $totalVoters > 0 ? round(($totalNotVoted / $totalVoters) * 100) : 0;

// Ambil hasil per kandidat
$candidatesQuery = mysqli_query($conn, "SELECT * FROM candidates_admin ORDER BY votes DESC");
$candidates = [];
$rank = 1;
while($row = mysqli_fetch_assoc($candidatesQuery)){
    $percentage = $totalVoted > 0 ? round(($row['votes'] / $totalVoted) * 100) : 0;
    
    if($rank == 1) {
        $status = "Winner";
    } elseif($rank == 2) {
        $status = "Runner-Up 1";
    } elseif($rank == 3) {
        $status = "Runner-Up 2";
    } else {
        $status = "-";
    }
    
    $candidates[] = [
        'no' => $rank,
        'name' => $row['name'],
        'votes' => $row['votes'],
        'percentage' => $percentage,
        'status' => $status
    ];
    $rank++;
}

$lastUpdated = date('d M Y, H:i') . ' WIB';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results & Report - SISVORA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            border-top: 1px solid rgba(0,0,0,0.08);
            border-top-right-radius: 50px;
            box-shadow: 2px 0 4px rgba(0,0,0,0.1);
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

        .main-content {
            background: #fff;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 76px);
        }
        
        .main-content.expanded {
            margin-left: 0;
        }

        .page-header {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .page-header h2 {
            color: #333;
            margin-bottom: 5px;
            font-size: 24px;
        }

        .page-header .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .page-header .last-updated {
            color: #999;
            font-size: 14px;
            font-style: italic;
        }

        .export-btn {
            background-color: #d4773c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            float: right;
            margin-top: -50px;
        }

        .export-btn:hover {
            background-color: #c06634;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }

        .stat-card i {
            font-size: 32px;
            margin-right: 15px;
        }

        .stat-card.voters i {
            color: #d4773c;
        }

        .stat-card.participants i {
            color: #d4773c;
        }

        .stat-card.submitted i {
            color: #d4773c;
        }

        .stat-card.not-submitted i {
            color: #d4773c;
        }

        .stat-info h3 {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-info .value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .status-section {
            margin-bottom: 25px;
        }

        .status-badge {
            display: inline-block;
            background-color: #d4773c;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .results-section {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .results-section h3 {
            margin-bottom: 30px;
            color: #333;
        }

        .chart-container {
            margin-bottom: 40px;
            text-align: center;
        }

        .chart-wrapper {
            max-width: 400px;
            margin: 0 auto 30px;
        }

        .chart-label {
            color: #999;
            font-style: italic;
            margin-top: 15px;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .results-table th {
            background-color: #d4773c;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        .results-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .results-table tbody tr:hover {
            background-color: #faf5f0;
        }

        .results-table .winner {
            color: #28a745;
            font-weight: bold;
        }

        .results-table .runner-up {
            color: #ffc107;
            font-weight: bold;
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
                <i class="fas fa-vote-yea"></i>
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
            <a href="dashboard.php" class="menu-item"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <a href="voters-data.php" class="menu-item"><i class="fas fa-users"></i><span>Voters Data</span></a>
            <a href="candidate-data.php" class="menu-item"><i class="fas fa-user-tie"></i><span>Candidate Data</span></a>
            <a href="election-settings.php" class="menu-item"><i class="fas fa-cog"></i><span>Election Settings</span></a>
            <a href="result&report.php" class="menu-item active"><i class="fas fa-chart-bar"></i><span>Results & Report</span></a>
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
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h2>Results & Report</h2>
            <p class="subtitle">Real-time recapitulation of voting results</p>
            <p class="last-updated">Last updated: <?php echo $lastUpdated; ?></p>
            <button class="export-btn" onclick="exportPDF()">
                <i class="fas fa-download"></i> Export as PDF
            </button>
        </div>

        <!-- Stats Row -->
        <div class="stats-row">
            <div class="stat-card voters">
                <i class="fas fa-users"></i>
                <div class="stat-info">
                    <h3>Total Voters: <?php echo $totalVoters; ?> orang</h3>
                </div>
            </div>
            <div class="stat-card participants">
                <i class="fas fa-user-check"></i>
                <div class="stat-info">
                    <h3>Total Participants: <?php echo $totalParticipants; ?> calon</h3>
                </div>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-card submitted">
                <i class="fas fa-check-circle"></i>
                <div class="stat-info">
                    <h3>Votes Submitted: <?php echo $totalVoted; ?> (<?php echo $votedPercentage; ?>%)</h3>
                </div>
            </div>
            <div class="stat-card not-submitted">
                <i class="fas fa-times-circle"></i>
                <div class="stat-info">
                    <h3>Votes Not Submitted: <?php echo $totalNotVoted; ?> (<?php echo $notVotedPercentage; ?>%)</h3>
                </div>
            </div>
        </div>

        <!-- Status Section -->
        <div class="status-section">
            <strong>Status:</strong>
            <span class="status-badge"><?php echo $electionStatus; ?></span>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <h3>Candidate Results</h3>

            <!-- Pie Chart -->
            <div class="chart-container">
                <div class="chart-wrapper">
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="chart-label">Pie Chart</div>
            </div>

            <!-- Bar Chart -->
            <div class="chart-container">
                <canvas id="barChart" style="max-height: 400px;"></canvas>
                <div class="chart-label">Bar Chart</div>
            </div>

            <!-- Results Table -->
            <table class="results-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Candidate name</th>
                        <th>Total Voters</th>
                        <th>Percentage</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($candidates as $candidate): ?>
                    <tr>
                        <td><?php echo $candidate['no']; ?>.</td>
                        <td><?php echo $candidate['name']; ?></td>
                        <td><?php echo $candidate['votes']; ?></td>
                        <td><?php echo $candidate['percentage']; ?>%</td>
                        <td class="<?php echo $candidate['no'] == 1 ? 'winner' : ($candidate['no'] <= 3 ? 'runner-up' : ''); ?>">
                            <?php echo $candidate['status']; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Data dari PHP
        const candidates = <?php echo json_encode($candidates); ?>;
        
        const labels = candidates.map(c => c.name);
        const dataValues = candidates.map(c => c.percentage);
        const colors = ['#5dade2', '#52d053', '#f7dc6f'];

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: colors,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels.map((l, i) => '%'),
                datasets: [{
                    label: 'Percentage',
                    data: dataValues,
                    backgroundColor: '#f7dc6f',
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 50
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        function exportPDF() {
            window.print();
        }

        // Auto refresh setiap 10 detik
        setInterval(function() {
            location.reload();
        }, 10000);
    </script>

    <script>
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
            window.location.href = "/logout"; 
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>