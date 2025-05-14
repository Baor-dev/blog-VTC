@extends('admin.dashboard')

@section('dashboard-content')
<style>
    .interactive-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .interactive-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container mt-4">
    <h2 class="fw-bold">📊 Thống Kê Hệ Thống</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="card shadow-lg text-center p-4 interactive-card">
                    <h5 class="fs-4">👥 Tổng Người Dùng</h5>
                    <p class="fs-3 fw-bold">{{ $totalUsers }}</p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.posts') }}" class="text-decoration-none">
                <div class="card shadow-lg text-center p-4 interactive-card">
                    <h5 class="fs-4">📝 Tổng Bài Viết</h5>
                    <p class="fs-3 fw-bold">{{ $totalPosts }}</p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="#" class="text-decoration-none">
                <div class="card shadow-lg text-center p-4 interactive-card">
                    <h5 class="fs-4">🔄 Bài Viết Đang Chờ Duyệt</h5>
                    <p class="fs-3 fw-bold">{{ $pendingPosts }}</p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="#" class="text-decoration-none">
                <div class="card shadow-lg text-center p-4 interactive-card">
                    <h5 class="fs-4">✅ Bài Viết Đã Duyệt</h5>
                    <p class="fs-3 fw-bold">{{ $approvedPosts }}</p>
                </div>
            </a>
        </div>
    </div>

    <h3 class="mt-5">🆕 Người Dùng Mới Nhất</h3>
    <ul class="list-group">
        @foreach ($latestUsers as $user)
            <li class="list-group-item">{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>

    <h3 class="mt-5">🆕 Bài Viết Mới Nhất</h3>
    <ul class="list-group">
        @foreach ($latestPosts as $post)
            <li class="list-group-item">{{ $post->title }}</li>
        @endforeach
    </ul>
</div>
@endsection