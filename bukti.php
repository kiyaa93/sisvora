<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Suara - Sisvora</title>
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
            background-color: #e5641f;
            color: white;
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
    <header class="fade-in">
        <div class="header-left">
            <div class="menu-icon" onclick="toggleSidebar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="logo">
                <img src="images/sisvora-logo.png" alt="Sisvora Logo">
            </div>
            <div class="search-bar">
                <svg class="search-icon" viewBox="0 0 30 30" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.125 3.75C7.94365 3.75 3.75 7.94365 3.75 13.125C3.75 18.3063 7.94365 22.5 13.125 22.5C15.4354 22.5 17.5521 21.6771 19.2042 20.3146L24.3198 25.4302C24.8104 25.9208 25.6021 25.9208 26.0927 25.4302C26.5833 24.9396 26.5833 24.1479 26.0927 23.6573L20.9771 18.5417C22.3396 16.8896 23.1625 14.7729 23.1625 12.4625C23.1625 7.28115 18.9688 3.0875 13.7875 3.0875L13.125 3.75ZM6.25 13.125C6.25 9.32365 9.32365 6.25 13.125 6.25C16.9263 6.25 20 9.32365 20 13.125C20 16.9263 16.9263 20 13.125 20C9.32365 20 6.25 16.9263 6.25 13.125Z" fill="#B03D00" fill-opacity="0.45"/>
                </svg>
                <input type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-icons">
            <button class="icon-btn">
                <svg viewBox="0 0 35 35" fill="none">
                    <path d="M17.5 3.28125C12.0156 3.28125 7.65625 7.64062 7.65625 13.125V18.5938L5.46875 22.9688C5.35156 23.2031 5.46875 23.4375 5.70312 23.5547C5.82031 23.6719 5.9375 23.6719 6.05469 23.6719H28.9453C29.0625 23.6719 29.1797 23.6719 29.2969 23.5547C29.5312 23.4375 29.6484 23.2031 29.5312 22.9688L27.3438 18.5938V13.125C27.3438 7.64062 22.9844 3.28125 17.5 3.28125ZM20 26.25H15C15 27.8906 16.25 29.1406 17.8906 29.1406C19.5312 29.1406 20.7812 27.8906 20.7812 26.25H20Z" fill="#E5641F"/>
                </svg>
            </button>
            <button class="icon-btn">
                <svg viewBox="0 0 45 45" fill="none">
                    <path d="M22.5 0C10.125 0 0 10.125 0 22.5C0 34.875 10.125 45 22.5 45C34.875 45 45 34.875 45 22.5C45 10.125 34.875 0 22.5 0ZM22.5 33.75C21.375 33.75 20.625 33 20.625 31.875C20.625 30.75 21.375 30 22.5 30C23.625 30 24.375 30.75 24.375 31.875C24.375 33 23.625 33.75 22.5 33.75ZM25.875 24.375C24.75 25.125 24.375 25.5 24.375 26.25V27H20.625V26.25C20.625 23.625 21.75 22.5 23.625 21.375C24.75 20.625 25.125 20.25 25.125 19.5C25.125 18.375 24 17.25 22.5 17.25C21 17.25 19.875 18.375 19.875 19.5H16.125C16.125 16.125 18.75 13.5 22.5 13.5C26.25 13.5 28.875 16.125 28.875 19.5C28.875 22.125 27.75 23.25 25.875 24.375Z" fill="#E5641F"/>
                </svg>
            </button>
            <button class="icon-btn user">
                <svg viewBox="0 0 60 60" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M30 0C13.5 0 0 13.5 0 30C0 46.5 13.5 60 30 60C46.5 60 60 46.5 60 30C60 13.5 46.5 0 30 0ZM30 15C25.875 15 22.5 18.375 22.5 22.5C22.5 26.625 25.875 30 30 30C34.125 30 37.5 26.625 37.5 22.5C37.5 18.375 34.125 15 30 15ZM45 42.75C45 45 43.125 46.875 40.875 46.875H19.125C16.875 46.875 15 45 15 42.75V40.5C15 36.375 18.375 33 22.5 33H37.5C41.625 33 45 36.375 45 40.5V42.75Z" fill="#B03D00"/>
                </svg>
            </button>
        </div>
    </header>

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
                <span class="user-status">Voted</span>
            </div>
        </div>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item" onclick="window.location.href='index.html'">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path d="M14.5833 32.0833V18.9583H20.4167V32.0833H27.7083V15.0417H32.0833L17.5 2.91666L2.91667 15.0417H7.29167V32.0833H14.5833Z" fill="#B03D00"/>
                    </svg>
                    <span class="nav-text">Dashboard</span>
                </li>
                <li class="nav-item active">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path d="M17.5 2.91666L2.91667 8.74999V15.0417C2.91667 23.3333 8.75 31.0417 17.5 32.0833C26.25 31.0417 32.0833 23.3333 32.0833 15.0417V8.74999L17.5 2.91666ZM14.5833 23.3333L8.75 17.5L10.7917 15.4583L14.5833 19.25L24.2083 9.62499L26.25 11.6667L14.5833 23.3333Z" fill="#B03D00"/>
                    </svg>
                    <span class="nav-text">Vote</span>
                </li>
                <li class="nav-item">
                    <svg class="nav-icon" viewBox="0 0 35 35" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.75 2.91666H26.25C27.7917 2.91666 29.1667 4.29166 29.1667 5.83333V29.1667C29.1667 30.7083 27.7917 32.0833 26.25 32.0833H8.75C7.20833 32.0833 5.83333 30.7083 5.83333 29.1667V5.83333C5.83333 4.29166 7.20833 2.91666 8.75 2.91666ZM11.6667 26.25H23.3333V23.3333H11.6667V26.25ZM23.3333 20.4167H11.6667V17.5H23.3333V20.4167ZM11.6667 14.5833H23.3333V11.6667H11.6667V14.5833Z" fill="#B03D00"/>
                    </svg>
                    <span class="nav-text">Voters Guideline</span>
                </li>
                <li class="nav-item">
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
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('mobile-hidden');
            sidebar.classList.toggle('mobile-visible');
        }

        function handleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logging out...');
                window.location.href = 'index.html';
            }
        }
    </script>
</body>
</html>
