@php
    $isStatsPage = request()->routeIs('admin.stats');
@endphp

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #fff;
            font-family: 'Figtree', sans-serif;
            color: black;
            overflow-y: auto;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            background: linear-gradient(120deg, #32a852, #46c765);
            color: white;
            padding-top: 20px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar h4 {
            text-align: center;
            color: white;
        }

        .sidebar a {
            padding: 12px;
            display: block;
            color: white;
            text-decoration: none;
            transition: 0.3s;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 20px;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            background: white;
            color: black;
            transition: all 0.3s ease-in-out;
            opacity: 0;
            transform: translateY(20px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }

        .popup-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 320px;
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
            border-radius: 12px;
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .popup-container.active {
            display: block;
            opacity: 1;
        }

        .popup-content {
            text-align: center;
        }

        .btn-green {
            background: linear-gradient(90deg, #32a852, #46c765);
            color: white;
            font-size: 16px;
            border-radius: 50px;
            padding: 10px;
            width: 100%;
            border: none;
            transition: all 0.4s ease-in-out;
        }

        .btn-green:hover {
            box-shadow: 0px 0px 10px rgba(50, 168, 82, 0.8);
            transform: scale(1.05);
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div id="logoutPopup" class="popup-container">
        <div class="popup-content">
            <h4>Bạn có chắc muốn đăng xuất?</h4>
            <button onclick="submitLogout()" class="btn btn-danger">Có</button>
            <button onclick="closePopup()" class="btn btn-secondary">Hủy</button>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ route('dashboard') }}">
            🔙 Quay về Trang chủ
        </a>
        <a href="{{ route('admin.users') }}">👤 Quản lý Người Dùng</a>
        <a href="{{ route('admin.posts') }}">📝 Kiểm Duyệt Bài Viết</a>
        <a href="{{ route('admin.stats') }}">📊 Thống Kê</a>

        <!-- Đã xóa nút đăng xuất khỏi sidebar -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="content fade-in">
        <div class="container">
            <!-- Dòng chứa lời chào và nút đăng xuất -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 id="welcomeMessage" class="mb-0"></h2>
                <!-- Nút Đăng Xuất -->
                @if($isStatsPage)
                     <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">🚪 Đăng Xuất</button>
                    </form>                   
                @else
                    <button onclick="openPopup()" class="btn btn-outline-danger">🚪 Đăng Xuất</button>
                @endif
            </div>

            <div id="dashboard-content">@yield('dashboard-content')</div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openPopup() {
            document.getElementById("logoutPopup").classList.add("active");
        }

        function closePopup() {
            document.getElementById("logoutPopup").classList.remove("active");
        }

        function submitLogout() {
            document.getElementById("logout-form").submit();
        }

        // Dynamic welcome message
        document.addEventListener("DOMContentLoaded", function () {
            const hours = new Date().getHours();
            let greeting;

            if (hours < 12) {
                greeting = "Chào buổi sáng, Admin!";
            } else if (hours < 18) {
                greeting = "Chào buổi chiều, Admin!";
            } else {
                greeting = "Chào buổi tối, Admin!";
            }

            document.getElementById("welcomeMessage").textContent = greeting;
        });
    </script>
</body>
</html>
