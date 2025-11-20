

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisvora - Student Voting System</title>
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
            background-color: #f7f1e5;
            overflow-x: hidden;
        }

        /* Animations */
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

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
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

        .navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
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
            border-left-color: var(--orange-dark);
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

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Main Content */
        .main-content {
            margin-left: clamp(280px, 25vw, 360px);
            margin-top: clamp(80px, 15vh, 150px);
            padding: clamp(20px, 3vw, 38px);
            min-height: calc(100vh - clamp(80px, 15vh, 150px));
        }

        .page-title {
            font-size: clamp(20px, 3.5vw, 30px);
            font-weight: 700;
            margin-bottom: clamp(20px, 3vh, 30px);
            color: var(--orange-primary);
        }

        .candidate-section {
            background-color: rgba(255, 255, 255, 0.45);
            border: 1px solid #d9d9d9;
            border-radius: clamp(20px, 2.5vw, 30px);
            padding: clamp(20px, 2.5vw, 40px);
            margin-bottom: clamp(15px, 2vh, 23px);
        }

        .candidate-header {
            margin-bottom: clamp(20px, 3vh, 32px);
        }

        .candidate-number {
            font-size: clamp(20px, 3vw, 25px);
            font-weight: 600;
            color: rgba(0, 0, 0);
            margin-bottom: clamp(6px, 1vh, 8px);
            text-align: center;
        }

        .candidate-note {
            font-size: clamp(14px, 2vw, 20px);
            font-weight: 500;
            color: rgba(0, 0, 0, 0.75);
            text-align: center;
        }

        .candidate-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(20px, 4vw, 59px);
        }

        .candidate-card {
            background: linear-gradient(180deg, #FF9A56 0%, white 60.91%);
            border: 1px solid #d9d9d9;
            border-radius: clamp(20px, 2.5vw, 30px);
            padding: clamp(20px, 3vw, 36px) clamp(15px, 2.5vw, 30px);
            text-align: center;
            position: relative;
        }

        .candidate-photo {
            width: clamp(120px, 15vw, 180px);
            height: clamp(120px, 15vw, 180px);
            margin: 0 auto clamp(10px, 1.5vh, 14px);
            border-radius: 50%;
            overflow: hidden;
            background-color: #d9d9d9;
        }

        .candidate-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .candidate-name {
            font-size: clamp(16px, 2vw, 22px);
            font-weight: 700;
            color: #000;
            margin-bottom: clamp(4px, 0.8vh, 6px);
        }

        .candidate-position {
            font-size: clamp(14px, 1.6vw, 20px);
            font-weight: 500;
            color: rgba(0, 0, 0, 0.6);
            margin-bottom: clamp(15px, 2.5vh, 24px);
        }

        .candidate-actions {
            display: flex;
            justify-content: center;
            gap: clamp(15px, 2.5vw, 30px);
            flex-wrap: wrap;
        }

        .btn {
            padding: clamp(10px, 1.2vh, 12px) clamp(20px, 2.5vw, 30px);
            border-radius: 50px;
            font-size: clamp(16px, 1.6vw, 20px);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background-color: #b03d00;
            color: white;
            min-width: clamp(100px, 12vw, 130px);
        }

        .btn-secondary {
            background-color: white;
            color: rgba(176, 61, 0, 0.6);
            border: 1px solid #b03d00;
            min-width: clamp(120px, 14vw, 150px);
            box-shadow: 0px 4px 8px 3px rgba(0, 0, 0, 0.15), 0px 1px 3px 0px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary:hover {
            background-color: #f7f1e5;
            box-shadow: 0px 6px 12px 3px rgba(0, 0, 0, 0.2), 0px 2px 4px 0px rgba(0, 0, 0, 0.35);
        }

        /* Modal Overlay */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 200;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-out;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        /* Alert Modal */
        .alert-modal {
            width: min(690px, 90vw);
            background-color: #f7f1e5;
            border-radius: clamp(20px, 3vw, 35px);
            padding: clamp(30px, 4vw, 50px) clamp(30px, 4vw, 50px) clamp(40px, 6vh, 70px);
            text-align: center;
            animation: slideIn 0.3s ease-out;
        }

        .alert-icon {
            width: clamp(100px, 15vw, 150px);
            height: clamp(100px, 15vw, 150px);
            margin: 0 auto clamp(20px, 3vh, 36px);
        }

        .alert-title {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            color: #000;
            margin-bottom: clamp(25px, 4vh, 41px);
        }

        .alert-message {
            font-size: clamp(18px, 2.2vw, 27px);
            color: rgba(0, 0, 0, 0.75);
            line-height: 1.4;
            margin-bottom: clamp(40px, 6vh, 68px);
        }

        .alert-actions {
            display: flex;
            justify-content: center;
            gap: clamp(20px, 3vw, 32px);
            flex-wrap: wrap;
        }

        .btn-cancel {
            background-color: transparent;
            color: #b03d00;
            border: 1px solid #b03d00;
            min-width: clamp(100px, 12vw, 130px);
        }

        .btn-confirm {
            background-color: #b03d00;
            color: white;
            min-width: clamp(140px, 16vw, 180px);
        }

        /* Details Modal */
        .details-modal {
            width: min(1285px, 95vw);
            max-height: 90vh;
            overflow-y: auto;
            background-color: #f7f1e5;
            border-radius: clamp(20px, 3vw, 35px);
            padding: clamp(30px, 4vh, 44px) 0 clamp(30px, 4vh, 50px);
            position: relative;
            animation: slideIn 0.3s ease-out;
        }

        .close-btn {
            position: absolute;
            top: clamp(20px, 3vh, 43px);
            right: clamp(20px, 3vw, 43px);
            width: clamp(25px, 3vw, 35px);
            height: clamp(25px, 3vw, 35px);
            background: none;
            border: none;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .close-btn:hover {
            transform: rotate(90deg);
        }

        .details-title {
            font-size: clamp(24px, 2.8vw, 32px);
            font-weight: 500;
            text-align: center;
            margin-bottom: clamp(25px, 4vh, 40px);
            color: #000;
            padding: 0 20px;
        }

        .candidates-row {
            display: flex;
            padding: 0 clamp(20px, 5vw, 68px);
            gap: clamp(40px, 20vw, 315px);
            margin-bottom: clamp(30px, 4vh, 46px);
            flex-wrap: wrap;
            justify-content: center;
        }

        .candidate-info {
            text-align: center;
            flex: 1;
            min-width: 200px;
        }

        .candidate-info .candidate-photo {
            margin-bottom: clamp(15px, 2.5vh, 24px);
        }

        .candidate-info .candidate-name {
            font-size: clamp(22px, 2.8vw, 32px);
            margin-bottom: clamp(3px, 0.5vh, 5px);
        }

        .candidate-info .candidate-label {
            font-size: clamp(16px, 1.8vw, 20px);
            font-weight: 600;
            color: rgba(0, 0, 0, 0.6);
            margin-bottom: 0;
        }

        .candidate-info .candidate-position {
            font-size: clamp(18px, 2.2vw, 25px);
            font-weight: 600;
            color: #b03d00;
            margin-bottom: 0;
        }

        .vision-mission {
            padding: 0 clamp(20px, 5vw, 68px);
            margin-bottom: clamp(50px, 15vh, 200px);
        }

        .section-title {
            font-size: clamp(20px, 2.2vw, 27px);
            font-weight: 700;
            color: #b03d00;
            margin-bottom: clamp(12px, 2vh, 20px);
        }

        .section-content {
            font-size: clamp(16px, 1.8vw, 20px);
            color: rgba(0, 0, 0, 0.75);
            line-height: 1.6;
            margin-bottom: clamp(25px, 4vh, 40px);
        }

        .details-vote-btn {
            display: block;
            margin: 0 auto;
            min-width: clamp(100px, 12vw, 130px);
        }

        /* Camera Verification Modal */
        .camera-modal {
            width: min(1285px, 95vw);
            background-color: #f7f1e5;
            border-radius: clamp(20px, 3vw, 35px);
            padding: clamp(30px, 4vw, 55px) clamp(20px, 4vw, 58px) clamp(40px, 6vh, 60px);
            position: relative;
            animation: slideIn 0.3s ease-out;
            text-align: center;
        }

        .camera-title {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            color: #000;
            margin-bottom: clamp(12px, 2vh, 20px);
        }

        .camera-instructions {
            font-size: clamp(18px, 2.2vw, 27px);
            color: rgba(0, 0, 0, 0.75);
            line-height: 1.4;
            margin-bottom: clamp(30px, 4vh, 46px);
        }

        .camera-frame {
            width: min(1170px, 100%);
            height: clamp(300px, 45vh, 590px);
            border: 3px dashed rgba(229, 100, 31, 0.45);
            margin: 0 auto clamp(30px, 5vh, 50px);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        .camera-icon {
            width: clamp(60px, 10vw, 100px);
            height: clamp(60px, 10vw, 100px);
            animation: pulse 2s ease-in-out infinite;
        }

        .camera-status {
            font-size: clamp(18px, 2.2vw, 27px);
            color: rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        /* Success Verification Modal */
        .success-modal {
            width: min(800px, 95vw);
            max-height: 90vh;
            overflow-y: auto;
            background-color: #f7f1e5;
            border-radius: clamp(20px, 3vw, 35px);
            padding: clamp(30px, 4vh, 49px) clamp(30px, 8vw, 122px) clamp(30px, 4vh, 50px);
            position: relative;
            animation: slideIn 0.3s ease-out;
            text-align: center;
        }

        .success-title {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            color: #000;
            margin-bottom: clamp(8px, 1.5vh, 12px);
        }

        .success-subtitle {
            font-size: clamp(18px, 2vw, 24px);
            font-weight: 500;
            color: rgba(0, 0, 0, 0.6);
            margin-bottom: clamp(40px, 6vh, 70px);
        }

        .verification-photo {
            width: clamp(180px, 20vw, 240px);
            height: clamp(230px, 28vw, 305px);
            margin: 0 auto clamp(30px, 5vh, 50px);
            border-radius: 10px;
            overflow: hidden;
            background-color: #d9d9d9;
        }

        .verification-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .verification-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: clamp(20px, 4vh, 40px) clamp(30px, 6vw, 80px);
            margin-bottom: clamp(30px, 5vh, 50px);
            text-align: left;
        }

        .verification-item {
            text-align: left;
        }

        .verification-label {
            font-size: clamp(18px, 2.2vw, 25px);
            font-weight: 600;
            color: #b03d00;
            margin-bottom: clamp(6px, 1vh, 8px);
        }

        .verification-value {
            font-size: clamp(18px, 2vw, 24px);
            font-weight: 600;
            color: rgba(0, 0, 0, 0.6);
            word-break: break-word;
        }

        .verification-value.location {
            color: darkorange;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .verification-value.location svg {
            flex-shrink: 0;
        }

        .btn-confirm-verification {
            background-color: #b03d00;
            color: white;
            min-width: clamp(140px, 16vw, 170px);
            display: block;
            margin: 0 auto;
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                overflow-y: auto;
            }

            .candidate-cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .search-bar {
                display: none;
            }

            .header-icons .icon-btn:not(.user) {
                width: clamp(20px, 4vw, 25px);
                height: clamp(20px, 4vw, 25px);
            }

            .alert-message br {
                display: none;
            }

            .camera-instructions br {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .candidates-row {
                flex-direction: column;
            }

            .candidate-info {
                width: 100%;
            }

            .verification-grid {
                grid-template-columns: 1fr;
            }

            .alert-actions,
            .candidate-actions {
                flex-direction: column;
                width: 100%;
            }

            .alert-actions .btn,
            .candidate-actions .btn {
                width: 100%;
            }
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

    <!-- Main Content -->
    <main class="main-content fade-in" id="mainContent">
        <h1 class="page-title">CAST YOUR VOTES NOW!</h1>

        <!-- Candidate 01 -->
        <section class="candidate-section">
            <div class="candidate-header">
                <h2 class="candidate-number">Candidate 01</h2>
                <p class="candidate-note">You can only vote for one candidate</p>
            </div>
            <div class="candidate-cards">
                <div class="candidate-card">
                    <div class="candidate-photo">
                        <img src="img/b1.png" alt="Malik Chandra Wirata">
                    </div>
                    <h3 class="candidate-name">Malik Chandra Wirata</h3>
                    <p class="candidate-position">President Student Council</p>
                    <div class="candidate-actions">
                        <button class="btn btn-primary" onclick="showVoteAlert('Malik Chandra Wirata')">VOTE</button>
                        <button class="btn btn-secondary" onclick="showDetails('candidate01')">View Details</button>
                    </div>
                </div>
                <div class="candidate-card">
                    <div class="candidate-photo">
                        <img src="img/g1.png" alt="Milania Rifa">
                    </div>
                    <h3 class="candidate-name">Milania Rifa</h3>
                    <p class="candidate-position">Vice President Student Council</p>
                    <div class="candidate-actions">
                        <button class="btn btn-primary" onclick="showVoteAlert('Milania Rifa')">VOTE</button>
                        <button class="btn btn-secondary" onclick="showDetails('candidate01')">View Details</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Candidate 02 -->
        <section class="candidate-section">
            <div class="candidate-header">
                <h2 class="candidate-number">Candidate 02</h2>
                <p class="candidate-note">You can only vote for one candidate</p>
            </div>
            <div class="candidate-cards">
                <div class="candidate-card">
                    <div class="candidate-photo">
                        <img src="img/b2.png" alt="Mahendra Yosa">
                    </div>
                    <h3 class="candidate-name">Mahendra Yosa</h3>
                    <p class="candidate-position">President Student Council</p>
                    <div class="candidate-actions">
                        <button class="btn btn-primary" onclick="showVoteAlert('Mahendra Yosa')">VOTE</button>
                        <button class="btn btn-secondary" onclick="showDetails('candidate02')">View Details</button>
                    </div>
                </div>
                <div class="candidate-card">
                    <div class="candidate-photo">
                        <img src="img/g1.png" alt="Jemima Saghi Larissa">
                    </div>
                    <h3 class="candidate-name">Jemima Saghi Larissa</h3>
                    <p class="candidate-position">Vice President Student Council</p>
                    <div class="candidate-actions">
                        <button class="btn btn-primary" onclick="showVoteAlert('Jemima Saghi Larissa')">VOTE</button>
                        <button class="btn btn-secondary" onclick="showDetails('candidate02')">View Details</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Candidate 03 -->
        <section class="candidate-section">
            <div class="candidate-header">
                <h2 class="candidate-number">Candidate 03</h2>
                <p class="candidate-note">You can only vote for one candidate</p>
            </div>
            <div class="candidate-cards">
                <div class="candidate-card">
                    <div class="candidate-photo">
                        <img src="img/b3.png" alt="Praditya Ghifar Saputra">
                    </div>
                    <h3 class="candidate-name">Praditya Ghifar Saputra</h3>
                    <p class="candidate-position">President Student Council</p>
                    <div class="candidate-actions">
                        <button class="btn btn-primary" onclick="showVoteAlert('Praditya Ghifar Saputra')">VOTE</button>
                        <button class="btn btn-secondary" onclick="showDetails('candidate03')">View Details</button>
                    </div>
                </div>
                <div class="candidate-card">
                    <div class="candidate-photo">
                        <img src="img/g3.png" alt="Kamaya Hanumi">
                    </div>
                    <h3 class="candidate-name">Kamaya Hanumi</h3>
                    <p class="candidate-position">Vice President Student Council</p>
                    <div class="candidate-actions">
                        <button class="btn btn-primary" onclick="showVoteAlert('Kamaya Hanumi')">VOTE</button>
                        <button class="btn btn-secondary" onclick="showDetails('candidate03')">View Details</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Vote Alert Modal -->
    <div class="modal-overlay" id="alertModal">
        <div class="alert-modal">
            <div class="alert-icon">
                <svg viewBox="0 0 150 150" fill="none">
                    <path d="M75 0L150 130.5H0L75 0ZM75 52.5C72.375 52.5 70.5 54.375 70.5 57V82.5C70.5 85.125 72.375 87 75 87C77.625 87 79.5 85.125 79.5 82.5V57C79.5 54.375 77.625 52.5 75 52.5ZM75 96C72.375 96 70.5 97.875 70.5 100.5C70.5 103.125 72.375 105 75 105C77.625 105 79.5 103.125 79.5 100.5C79.5 97.875 77.625 96 75 96Z" fill="#B03D00"/>
                </svg>
            </div>
            <h2 class="alert-title">Are you sure to vote?</h2>
            <p class="alert-message">
                Make sure you have carefully read the candidate's <br>
                vision and mission. You only get one chance to vote. <br>
                This election cannot be repeated.
            </p>
            <div class="alert-actions">
                <button class="btn btn-cancel" onclick="closeAlert()">CANCEL</button>
                <button class="btn btn-confirm" onclick="confirmVoteAlert()">YES, I'M SURE</button>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal-overlay" id="detailsModal">
        <div class="details-modal">
            <button class="close-btn" onclick="closeDetails()">
                <svg viewBox="0 0 35 35" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 0C7.83333 0 0 7.83333 0 17.5C0 27.1667 7.83333 35 17.5 35C27.1667 35 35 27.1667 35 17.5C35 7.83333 27.1667 0 17.5 0ZM23.3333 21.875L21.875 23.3333L17.5 18.9583L13.125 23.3333L11.6667 21.875L16.0417 17.5L11.6667 13.125L13.125 11.6667L17.5 16.0417L21.875 11.6667L23.3333 13.125L18.9583 17.5L23.3333 21.875Z" fill="#09244B"/>
                </svg>
            </button>
            <h2 class="details-title">Details</h2>
            <div class="candidates-row">
                <div class="candidate-info">
                    <div class="candidate-photo">
                        <img src="img/b1.png" alt="Malik Chandra Wirata">
                    </div>
                    <h3 class="candidate-name">Malik Chandra Wirata</h3>
                    <p class="candidate-label">for</p>
                    <p class="candidate-position">President Student Council</p>
                </div>
                <div class="candidate-info">
                    <div class="candidate-photo">
                        <img src="img/g1.png" alt="Milania Rifa">
                    </div>
                    <h3 class="candidate-name">Milania Rifa</h3>
                    <p class="candidate-label">for</p>
                    <p class="candidate-position">VICE President Student</p>
                </div>
            </div>
            <div class="vision-mission">
                <h3 class="section-title">Vision</h3>
                <p class="section-content">
                    To create an inclusive and dynamic student community that promotes academic excellence, 
                    personal growth, and social responsibility.
                </p>
                <h3 class="section-title">Mission</h3>
                <p class="section-content">
                    1. Enhance student engagement through diverse programs and activities<br>
                    2. Foster a culture of collaboration and mutual respect<br>
                    3. Advocate for student rights and welfare<br>
                    4. Bridge communication between students and administration
                </p>
            </div>
            <button class="btn btn-primary details-vote-btn" onclick="showVoteAlertFromDetails()">VOTE</button>
        </div>
    </div>

    <!-- Camera Verification Modal -->
    <div class="modal-overlay" id="cameraModal">
        <div class="camera-modal">
            <h1 class="camera-title">Let's Verify Your Identity</h1>
            <p class="camera-instructions">
                Posisikan wajah menghadap tepat ke kamera. Jangan gunakan masker. <br>
                Pastikan kondisi sekitar memiliki cahaya yang cukup.
            </p>
            <div class="camera-frame">
                <div class="camera-icon">
                    <svg viewBox="0 0 100 100" fill="none">
                        <path d="M37.5 12.5H25C20.8333 12.5 17.5 15.8333 17.5 20V80C17.5 84.1667 20.8333 87.5 25 87.5H75C79.1667 87.5 82.5 84.1667 82.5 80V20C82.5 15.8333 79.1667 12.5 75 12.5H62.5M37.5 12.5V16.6667C37.5 18.75 39.1667 20.4167 41.25 20.4167H58.75C60.8333 20.4167 62.5 18.75 62.5 16.6667V12.5M37.5 12.5H62.5M50 70.8333C59.2083 70.8333 66.6667 63.375 66.6667 54.1667C66.6667 44.9583 59.2083 37.5 50 37.5C40.7917 37.5 33.3333 44.9583 33.3333 54.1667C33.3333 63.375 40.7917 70.8333 50 70.8333ZM50 62.5C54.6042 62.5 58.3333 58.7708 58.3333 54.1667C58.3333 49.5625 54.6042 45.8333 50 45.8333C45.3958 45.8333 41.6667 49.5625 41.6667 54.1667C41.6667 58.7708 45.3958 62.5 50 62.5Z" stroke="#B03D00" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                </div>
            </div>
            <p class="camera-status">Turn on your camera.</p>
        </div>
    </div>

    <!-- Success Verification Modal -->
    <div class="modal-overlay" id="successModal">
        <div class="success-modal">
            <h1 class="success-title">SUCCESS!</h1>
            <p class="success-subtitle">Your identity has verified. Check before confirm.</p>
            
            <div class="verification-photo">
                <img src="images/jan-adam-photo.png" alt="Jan Adam">
            </div>
            
            <div class="verification-grid">
                <div class="verification-item">
                    <div class="verification-label">NIS</div>
                    <div class="verification-value">012345678</div>
                </div>
                <div class="verification-item">
                    <div class="verification-label">LOCATION</div>
                    <div class="verification-value location">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="#FF8C00"/>
                        </svg>
                        <span>-1.995243965</span>
                    </div>
                </div>
                <div class="verification-item">
                    <div class="verification-label">NAME</div>
                    <div class="verification-value">Jan Adam</div>
                </div>
                <div class="verification-item">
                    <div class="verification-label">TIME</div>
                    <div class="verification-value">09:28 WIB</div>
                </div>
            </div>
            
            <button class="btn btn-confirm-verification" onclick="confirmVerification()">CONFIRM</button>
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

        // Sidebar Toggle
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("mainContent").classList.toggle("expanded");
        }

        // NEW FLOW: VOTE → ALERT → CAMERA → SUCCESS → PROOF
        let currentCandidate = '';
        
        // Step 1: Show Vote Alert first
        function showVoteAlert(candidateName) {
            currentCandidate = candidateName;
            document.getElementById('alertModal').classList.add('active');
        }

        // Close Alert
        function closeAlert() {
            document.getElementById('alertModal').classList.remove('active');
        }

        // Step 2: After clicking "YES, I'M SURE" → Show Camera
        function confirmVoteAlert() {
            closeAlert();
            document.getElementById('cameraModal').classList.add('active');
            
            // Simulate camera verification after 3 seconds
            setTimeout(() => {
                closeCameraModal();
                document.getElementById('successModal').classList.add('active');
            }, 3000);
        }

        // Close Camera Modal
        function closeCameraModal() {
            document.getElementById('cameraModal').classList.remove('active');
        }

        // Close Success Modal
        function closeSuccessModal() {
            document.getElementById('successModal').classList.remove('active');
        }

        // Step 3: After confirming identity → Redirect to Proof Page
        function confirmVerification() {
            closeSuccessModal();
            // Update user status
            document.querySelector('.user-status').textContent = 'Voted';
            document.querySelector('.user-status').style.backgroundColor = '#e5641f';
            document.querySelector('.user-status').style.color = 'white';
            // Redirect to proof page
            window.location.href = 'bukti.php';
        }

        // Show Details Modal
        function showDetails(candidateId) {
            document.getElementById('detailsModal').classList.add('active');
        }

        // Close Details
        function closeDetails() {
            document.getElementById('detailsModal').classList.remove('active');
        }

        // Show Vote Alert from Details Modal
        function showVoteAlertFromDetails() {
            closeDetails();
            showVoteAlert('Malik Chandra Wirata & Milania Rifa');
        }

        // Handle Logout
        function handleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logging out...');
            }
        }

        // Close modals when clicking outside
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAlert();
                closeDetails();
                closeCameraModal();
                closeSuccessModal();
            }
        });

        // Proses logout
        confirmLogout.addEventListener("click", function() {
            window.location.href = "logout.php"; 
        });

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
