@extends('admin.dashboard')

@section('dashboard-content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .interactive-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .interactive-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Position the logout button to overlay the existing button */
    #logoutButtonStats {
        position: absolute;
        top: 10px; /* Adjust top as needed */
        right: 10px; /* Adjust right as needed */
        z-index: 999; /* Make sure it's above the content */
        width: 120px; /* Button size */
    }
</style>

<div class="container mt-4">
    <h2 class="fw-bold">📊 Thống Kê Hệ Thống</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="card shadow-lg text-center p-4 interactive-card">
                    <h5 class="fs-4">👥 Tổng Người Dùng</h5>
                    <p class="fs-3 fw-bold">{{ number_format($totalUsers) }}</p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.posts') }}" class="text-decoration-none">
                <div class="card shadow-lg text-center p-4 interactive-card">
                    <h5 class="fs-4">📝 Tổng Bài Viết</h5>
                    <p class="fs-3 fw-bold">{{ number_format($totalPosts) }}</p>
                </div>
            </a>
        </div>
    </div>

    <!-- 🔥 Chart Section -->
    <h3 class="mt-5 fw-bold text-primary">📈 Biểu Đồ Bài Viết</h3>
    <div style="max-width: 500px; height: 300px;">
        <canvas id="postChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('postChart').getContext('2d');
        var postChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['⏳ Chờ duyệt', '✅ Đã duyệt'],
                datasets: [{
                    label: 'Bài viết',
                    data: [{{ $pendingPosts }}, {{ $approvedPosts }}],
                    backgroundColor: ['#f7b731', '#26de81'],
                    borderRadius: 6,
                    barPercentage: 0.5,
                    categoryPercentage: 0.5,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Tổng: ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

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
