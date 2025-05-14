<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlogMaster</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Figtree', sans-serif;
        }
        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            position: relative;
            overflow: hidden;
            background: url('your-background-image.jpg') no-repeat center center/cover;
        }
        .welcome-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
        }
        .btn-custom {
            width: 180px;
            margin: 10px;
            padding: 12px;
            font-size: 18px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.4s ease-in-out;
        }
        .btn-green {
            background: linear-gradient(90deg, #32a852, #46c765);
            color: white;
            border: none;
        }
        .btn-green:hover {
            box-shadow: 0px 0px 15px rgba(50, 168, 82, 0.8);
            transform: scale(1.05);
        }
        .btn-green:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body>
        <div class="welcome-container">
        <div class="welcome-box">
            <h1 class="text-dark fw-bold">Chào mừng đến với BlogMaster!</h1>
            <p class="text-muted">Bắt đầu blog của bạn ngay bây giờ!</p>
            <a href="{{ route('login') }}" class="btn btn-green btn-custom">Đăng Nhập</a>
            <a href="{{ route('register') }}" class="btn btn-green btn-custom">Đăng Ký</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".welcome-box").style.opacity = "0";
            document.querySelector(".welcome-box").style.transform = "translateY(20px)";
            setTimeout(() => {
                document.querySelector(".welcome-box").style.transition = "opacity 1s ease-in-out, transform 1s ease-in-out";
                document.querySelector(".welcome-box").style.opacity = "1";
                document.querySelector(".welcome-box").style.transform = "translateY(0)";
            }, 500);
        });
    </script>
    @if (Auth::check())
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif
</body>
</html>