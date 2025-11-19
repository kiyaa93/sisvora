


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisvora - Student Voting System</title>
    <style>
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

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: clamp(80px, 15vh, 135px);
            background-color: #f7f1e5;
            z-index: 100;
            padding: 0 clamp(20px, 4vw, 51px);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: clamp(20px, 5vw, 75px);
        }

        .menu-icon {
            width: clamp(35px, 5vw, 45px);
            height: clamp(35px, 5vw, 45px);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: clamp(4px, 1vw, 6px);
        }

        .menu-icon span {
            width: 100%;
            height: clamp(3px, 0.5vw, 4px);
            background-color: #000;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .logo {
            width: clamp(60px, 10vw, 135px);
            height: clamp(60px, 10vw, 135px);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .search-bar {
            width: clamp(200px, 40vw, 730px);
            height: clamp(45px, 6vh, 65px);
            background-color: rgba(255, 255, 255, 0.45);
            border: 1px solid rgba(229, 100, 31, 0.45);
            border-radius: 50px;
            display: flex;
            align-items: center;
            padding: 0 clamp(15px, 2vw, 20px);
            gap: clamp(10px, 1.5vw, 15px);
        }

        .search-icon {
            width: clamp(20px, 3vw, 30px);
            height: clamp(20px, 3vw, 30px);
            opacity: 0.45;
            flex-shrink: 0;
        }

        .search-bar input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: clamp(14px, 1.5vw, 18px);
            outline: none;
            font-weight: 500;
            min-width: 0;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: clamp(15px, 2.5vw, 31px);
        }

        .icon-btn {
            width: clamp(25px, 3vw, 35px);
            height: clamp(25px, 3vw, 35px);
            background: none;
            border: none;
            cursor: pointer;
            position: relative;
            transition: transform 0.2s;
            flex-shrink: 0;
        }

        .icon-btn:hover {
            transform: scale(1.1);
        }

        .icon-btn.user {
            width: clamp(40px, 5vw, 60px);
            height: clamp(40px, 5vw, 60px);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: clamp(80px, 15vh, 150px);
            width: clamp(280px, 25vw, 360px);
            height: calc(100vh - clamp(80px, 15vh, 150px));
            background-color: #f6d4b7;
            border-top-right-radius: clamp(30px, 4vw, 50px);
            padding-top: clamp(20px, 3vh, 33px);
            z-index: 50;
            transition: transform 0.3s;
        }

        .sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        .user-profile {
            padding: 0 clamp(30px, 8vw, 97px);
            text-align: center;
            margin-bottom: clamp(30px, 6vh, 70px);
        }

        .user-avatar {
            width: clamp(70px, 8vw, 100px);
            height: clamp(70px, 8vw, 100px);
            margin: 0 auto clamp(5px, 1vh, 7px);
            background-color: #b03d00;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar svg {
            width: 100%;
            height: 100%;
        }

        .user-name {
            font-size: clamp(20px, 2.2vw, 26px);
            font-weight: 700;
            margin-bottom: clamp(8px, 1vh, 10px);
            color: #000;
        }

        .user-status-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            flex-wrap: wrap;
        }

        .user-role {
            font-size: clamp(14px, 1.5vw, 18px);
            color: rgba(0, 0, 0, 0.25);
        }

        .user-status {
            background-color: #f7f1e5;
            color: #b03d00;
            padding: 0 5px;
            border-radius: 8px;
            font-size: clamp(14px, 1.5vw, 18px);
            font-weight: 500;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            height: clamp(60px, 7vh, 75px);
            display: flex;
            align-items: center;
            padding-left: clamp(30px, 4vw, 49px);
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .nav-item:hover {
            background: linear-gradient(to right, rgba(229, 100, 31, 0.1), transparent);
        }

        .nav-item.active {
            background: linear-gradient(to right, #e5641f, #ffc9ac);
            border-top-right-radius: clamp(30px, 4vw, 50px);
            border-bottom-right-radius: clamp(30px, 4vw, 50px);
        }

        .nav-item.active .nav-text {
            color: white;
        }

        .nav-item.active .nav-icon {
            filter: brightness(0) invert(1);
        }

        .nav-icon {
            width: clamp(25px, 3vw, 35px);
            height: clamp(25px, 3vw, 35px);
            margin-right: clamp(15px, 2.5vw, 29px);
            flex-shrink: 0;
        }

        .nav-text {
            font-size: clamp(18px, 2vw, 24px);
            font-weight: 600;
            color: #b03d00;
        }

        .nav-item.logout {
            position: absolute;
            bottom: clamp(30px, 5vh, 50px);
            width: 100%;
        }

        /* Main Content */
        .main-content {
            margin-left: clamp(280px, 25vw, 360px);
            margin-top: clamp(80px, 15vh, 150px);
            padding: clamp(20px, 3vw, 38px);
            min-height: calc(100vh - clamp(80px, 15vh, 150px));
        }

        .page-title {
            font-size: clamp(24px, 3.5vw, 40px);
            font-weight: 700;
            margin-bottom: clamp(20px, 3vh, 30px);
            color: #000;
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
            font-size: clamp(24px, 3vw, 35px);
            font-weight: 600;
            color: #000;
            margin-bottom: clamp(6px, 1vh, 8px);
        }

        .candidate-note {
            font-size: clamp(16px, 2vw, 24px);
            font-weight: 500;
            color: rgba(0, 0, 0, 0.75);
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
            font-size: clamp(18px, 2.2vw, 27px);
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
    </style>
</head>
<body>
    <!-- Header -->
    <header class="fade-in">
        <div class="header-left">
            <div class="menu-icon" onclick="toggleSidebar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="logo">
                <img src="img/logo.png" alt="Sisvora Logo">
            </div>
            <div class="search-bar">
                <svg class="search-icon" viewBox="0 0 30 30" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.125 3.75C7.94365 3.75 3.75 7.94365 3.75 13.125C3.75 18.3063 7.94365 22.5 13.125 22.5C15.4354 22.5 17.5521 21.6771 19.2042 20.3146L24.3198 25.4302C24.8104 25.9208 25.6021 25.9208 26.0927 25.4302C26.5833 24.9396 26.5833 24.1479 26.0927 23.6573L20.9771 18.5417C22.3396 16.8896 23.1625 14.7729 23.1625 12.4625C23.1625 7.28115 18.9688 3.0875 13.7875 3.0875L13.125 3.75ZM6.25 13.125C6.25 9.32365 9.32365 6.25 13.125 6.25C16.9263 6.25 20 9.32365 20 13.125C20 16.9263 16.9263 20 13.125 20C9.32365 20 6.25 16.9263 6.25 13.125Z" fill="#B03D00" fill-opacity="0.45"/>
                </svg>
                <input type="text" placeholder="Search candidates...">
            </div>
        </div>
        <div class="header-icons">
            <button class="icon-btn" aria-label="Notifications">
                <svg viewBox="0 0 35 35" fill="none">
                    <path d="M17.5 3.28125C12.0156 3.28125 7.65625 7.64062 7.65625 13.125V18.5938L5.46875 22.9688C5.35156 23.2031 5.46875 23.4375 5.70312 23.5547C5.82031 23.6719 5.9375 23.6719 6.05469 23.6719H28.9453C29.0625 23.6719 29.1797 23.6719 29.2969 23.5547C29.5312 23.4375 29.6484 23.2031 29.5312 22.9688L27.3438 18.5938V13.125C27.3438 7.64062 22.9844 3.28125 17.5 3.28125ZM20 26.25H15C15 27.8906 16.25 29.1406 17.8906 29.1406C19.5312 29.1406 20.7812 27.8906 20.7812 26.25H20Z" fill="#E5641F"/>
                </svg>
            </button>
            <button class="icon-btn" aria-label="Help">
                <svg viewBox="0 0 45 45" fill="none">
                    <path d="M22.5 0C10.125 0 0 10.125 0 22.5C0 34.875 10.125 45 22.5 45C34.875 45 45 34.875 45 22.5C45 10.125 34.875 0 22.5 0ZM22.5 33.75C21.375 33.75 20.625 33 20.625 31.875C20.625 30.75 21.375 30 22.5 30C23.625 30 24.375 30.75 24.375 31.875C24.375 33 23.625 33.75 22.5 33.75ZM25.875 24.375C24.75 25.125 24.375 25.5 24.375 26.25V27H20.625V26.25C20.625 23.625 21.75 22.5 23.625 21.375C24.75 20.625 25.125 20.25 25.125 19.5C25.125 18.375 24 17.25 22.5 17.25C21 17.25 19.875 18.375 19.875 19.5H16.125C16.125 16.125 18.75 13.5 22.5 13.5C26.25 13.5 28.875 16.125 28.875 19.5C28.875 22.125 27.75 23.25 25.875 24.375Z" fill="#E5641F"/>
                </svg>
            </button>
            <button class="icon-btn user" aria-label="Profile">
                <svg viewBox="0 0 60 60" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M30 0C13.5 0 0 13.5 0 30C0 46.5 13.5 60 30 60C46.5 60 60 46.5 60 30C60 13.5 46.5 0 30 0ZM30 15C25.875 15 22.5 18.375 22.5 22.5C22.5 26.625 25.875 30 30 30C34.125 30 37.5 26.625 37.5 22.5C37.5 18.375 34.125 15 30 15ZM45 42.75C45 45 43.125 46.875 40.875 46.875H19.125C16.875 46.875 15 45 15 42.75V40.5C15 36.375 18.375 33 22.5 33H37.5C41.625 33 45 36.375 45 40.5V42.75Z" fill="#B03D00"/>
                </svg>
            </button>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar mobile-hidden fade-in">
        <div class="user-profile">
            <div class="user-avatar">
                <svg viewBox="0 0 100 100" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M50 0C22.5 0 0 22.5 0 50C0 77.5 22.5 100 50 100C77.5 100 100 77.5 100 50C100 22.5 77.5 0 50 0ZM50 25C43.125 25 37.5 30.625 37.5 37.5C37.5 44.375 43.125 50 50 50C56.875 50 62.5 44.375 62.5 37.5C62.5 30.625 56.875 25 50 25ZM75 71.25C75 75 71.875 78.125 68.125 78.125H31.875C28.125 78.125 25 75 25 71.25V67.5C25 60.625 30.625 55 37.5 55H62.5C69.375 55 75 60.625 75 67.5V71.25Z" fill="white"/>
                </svg>
            </div>
            <div class="user-name">Jan Adam</div>
            <div class="user-status-wrapper">
                <span class="user-role">Student</span>
                <span class="user-status">Unvoted</span>
            </div>
        </div>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item" data-page="dashboard">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path d="M14.5833 32.0833V18.9583H20.4167V32.0833H27.7083V15.0417H32.0833L17.5 2.91666L2.91667 15.0417H7.29167V32.0833H14.5833Z" fill="#B03D00"/>
                    </svg>
                    <span class="nav-text">Dashboard</span>
                </li>
                <li class="nav-item active" data-page="vote">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path d="M17.5 2.91666L2.91667 8.74999V15.0417C2.91667 23.3333 8.75 31.0417 17.5 32.0833C26.25 31.0417 32.0833 23.3333 32.0833 15.0417V8.74999L17.5 2.91666ZM14.5833 23.3333L8.75 17.5L10.7917 15.4583L14.5833 19.25L24.2083 9.62499L26.25 11.6667L14.5833 23.3333Z" fill="#B03D00"/>
                    </svg>
                    <span class="nav-text">Vote</span>
                </li>
                <li class="nav-item" data-page="guideline">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.75 2.91666H26.25C27.7917 2.91666 29.1667 4.29166 29.1667 5.83333V29.1667C29.1667 30.7083 27.7917 32.0833 26.25 32.0833H8.75C7.20833 32.0833 5.83333 30.7083 5.83333 29.1667V5.83333C5.83333 4.29166 7.20833 2.91666 8.75 2.91666ZM11.6667 26.25H23.3333V23.3333H11.6667V26.25ZM23.3333 20.4167H11.6667V17.5H23.3333V20.4167ZM11.6667 14.5833H23.3333V11.6667H11.6667V14.5833Z" fill="#B03D00"/>
                    </svg>
                    <span class="nav-text">Voters Guideline</span>
                </li>
                <li class="nav-item" data-page="settings">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 11.6667C14.5833 11.6667 12.25 14 12.25 16.9167C12.25 19.8333 14.5833 22.1667 17.5 22.1667C20.4167 22.1667 22.75 19.8333 22.75 16.9167C22.75 14 20.4167 11.6667 17.5 11.6667ZM29.1667 17.5C29.1667 16.625 29.1667 15.75 28.875 15.1667L31.5 13.125C31.7917 12.8333 31.7917 12.25 31.5 11.9583L29.1667 7.875C28.875 7.58333 28.2917 7.58333 28 7.875L24.7917 9.33333C24.2083 8.75 23.625 8.16666 23.0417 7.875L22.75 4.66666C22.75 4.08333 22.4583 3.79166 21.875 3.79166H17.5C16.9167 3.79166 16.625 4.08333 16.625 4.66666L16.3333 7.875C15.75 8.16666 15.1667 8.75 14.5833 9.33333L11.375 7.875C11.0833 7.58333 10.5 7.58333 10.2083 7.875L7.875 11.9583C7.58333 12.25 7.58333 12.8333 7.875 13.125L10.5 15.1667C10.2083 15.75 10.2083 16.625 10.2083 17.5C10.2083 18.375 10.2083 19.25 10.5 19.8333L7.875 21.875C7.58333 22.1667 7.58333 22.75 7.875 23.0417L10.2083 27.125C10.5 27.4167 11.0833 27.4167 11.375 27.125L14.5833 25.6667C15.1667 26.25 15.75 26.8333 16.3333 27.125L16.625 30.3333C16.625 30.9167 16.9167 31.2083 17.5 31.2083H21.875C22.4583 31.2083 22.75 30.9167 22.75 30.3333L23.0417 27.125C23.625 26.8333 24.2083 26.25 24.7917 25.6667L28 27.125C28.2917 27.4167 28.875 27.4167 29.1667 27.125L31.5 23.0417C31.7917 22.75 31.7917 22.1667 31.5 21.875L28.875 19.8333C29.1667 19.25 29.1667 18.375 29.1667 17.5Z" fill="#B03D00"/>
                    </svg>
                    <span class="nav-text">Settings</span>
                </li>
                <li class="nav-item logout" onclick="handleLogout()">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path d="M13.125 10.9375V8.75C13.125 6.5625 14.875 4.8125 17.0625 4.8125H26.25C28.4375 4.8125 30.1875 6.5625 30.1875 8.75V26.25C30.1875 28.4375 28.4375 30.1875 26.25 30.1875H17.0625C14.875 30.1875 13.125 28.4375 13.125 26.25V24.0625M8.75 17.5H24.0625M8.75 17.5L13.125 13.125M8.75 17.5L13.125 21.875" stroke="#B03D00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="nav-text">Logout</span>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content fade-in">
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
                        <img src="images/malik-chandra.png" alt="Malik Chandra Wirata">
                    </div>
                    <h3 class="candidate-name">Malik Chandra Wirata</h3>
                    <p class="candidate-label">for</p>
                    <p class="candidate-position">President Student Council</p>
                </div>
                <div class="candidate-info">
                    <div class="candidate-photo">
                        <img src="images/milania-rifa.png" alt="Milania Rifa">
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

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('mobile-hidden');
            sidebar.classList.toggle('mobile-visible');
        }

        // Navigation
        document.querySelectorAll('.nav-item:not(.logout)').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

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
    </script>
</body>
</html>
