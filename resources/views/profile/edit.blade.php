<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hồ sơ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <!-- 🔥 Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3">
        <div class="container">
            <!-- Dashboard Button -->
            <a href="{{ route('dashboard') }}" class="btn btn-primary fw-bold">
                ⬅️ Quay lại Dashboard
            </a>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger fw-bold">
                    🚪 Đăng Xuất
                </button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="fw-bold fs-2 text-primary">✏️ Chỉnh sửa thông tin cá nhân</h2>

        <div class="card shadow-lg p-4 mt-4">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <label class="fw-semibold fs-5 mt-3">Tên</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control border p-2" required>

                <label class="fw-semibold fs-5 mt-4">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control border p-2" required>

                <button type="submit" class="btn btn-success mt-4 fw-bold">💾 Cập nhật thông tin</button>
            </form>
        </div>
    </div>
</body>
</html>