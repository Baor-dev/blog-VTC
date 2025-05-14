<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản của tôi</title>
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
        <!-- Tiêu đề chính -->
        <h2 class="fw-bold fs-2 mb-4 text-primary">🧑‍💼 Tài khoản của tôi</h2>

        <!-- Personal Info Card -->
        <div class="card p-4 shadow-lg mb-5">
            <p class="fs-5"><strong>Tên:</strong> {{ $user->name }}</p>
            <p class="fs-5"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="fs-5"><strong>Vai trò:</strong> {{ ucfirst($user->role) }}</p>
            
            <a href="{{ route('profile.edit') }}" class="btn btn-warning mt-3 fs-6 fw-semibold">
                ✏️ Cập nhật thông tin
            </a>
        </div>

        <!-- My Posts Section -->
        <h3 class="fw-bold fs-3 mb-3 text-success">📝 Bài Viết Của Tôi</h3>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card shadow-lg p-4 position-relative h-100 d-flex flex-column">
                        <!-- Nút tròn chứa icon ở góc phải -->
                        <div class="position-absolute top-0 end-0 m-2 d-flex gap-2">
                            <!-- Nút chỉnh sửa -->
                            <a href="{{ route('posts.edit', $post->id) }}" 
                            class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;" title="Chỉnh sửa">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <!-- Nút xóa -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirmDelete(event);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;" title="Xóa">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Nội dung bài viết -->
                        <h4 class="fw-bold fs-4 text-dark">{{ $post->title }}</h4>
                        <p class="text-muted flex-grow-1"> <!-- Ensures text takes available space -->
                            Trạng thái:  
                            @if($post->status === 'approved')
                                <span class="text-success">✅ Đã Duyệt</span>
                            @else
                                <span class="text-warning">⏳ Đang Chờ Duyệt</span>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Stop form from submitting immediately
            
            if (confirm("🚨 Bạn có chắc chắn muốn xóa bài viết này?")) {
                event.target.submit(); // If confirmed, submit the form
            }
        }
    </script>
</body>
</html>