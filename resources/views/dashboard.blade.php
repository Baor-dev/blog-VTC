<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Bài Viết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-green-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center flex-wrap gap-4">
            <h2 class="text-2xl font-semibold text-green-700">📜 Danh Sách Bài Viết</h2>

            <div class="flex flex-wrap gap-4">
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" 
                       class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-md">
                        🔧 Admin Panel
                    </a>
                @endif

                <a href="{{ route('posts.export') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md">
                    📁 Xuất danh sách bài viết
                </a>

                <a href="{{ route('posts.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md">
                    ✍️ Tạo Bài Viết
                </a>

                <a href="{{ route('profile') }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md shadow-md">
                    🧑‍💼 Tài khoản của tôi
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md">
                        🚪 Đăng Xuất
                    </button>
                </form>
            </div>
        </div>

        <!-- Posts Table -->
        <div class="mt-6 bg-white shadow-md rounded-lg p-6">
            @if ($posts->isEmpty())
                <p class="text-gray-600 text-center text-lg">📭 Không có bài viết nào.</p>
            @else
                <div class="overflow-x-auto">
                    <table id="postsTable" class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th class="p-4 border">Tiêu đề</th>
                                <th class="p-4 border">Mô tả ngắn</th>
                                <th class="p-4 border">Banner</th>
                                <th class="p-4 border">Gallery</th>
                                <th class="p-4 border">Tác giả</th>
                                <th class="p-4 border">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                @if ($post->status === 'approved')
                                    <tr class="border border-gray-200 text-gray-700">
                                        <td class="p-4">{{ $post->title }}</td>
                                        <td class="p-4">{{ Str::limit($post->short_description, 100) }}</td>
                                        <td class="p-4">
                                            <img src="{{ asset('storage/' . $post->banner_image) }}" 
                                                 alt="Banner" 
                                                 class="w-20 h-20 object-cover rounded">
                                        </td>
                                        <td class="p-4">
                                            @if($post->gallery_images)
                                                @foreach(json_decode($post->gallery_images, true) as $image)
                                                    <img src="{{ asset('storage/' . $image) }}" 
                                                         class="w-12 h-12 object-cover rounded inline-block mr-1 mb-1">
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">Không có ảnh</span>
                                            @endif
                                        </td>
                                        <td class="p-4">{{ optional($post->author)->name ?? 'Không xác định' }}</td>
                                        <td class="p-4">
                                            <a href="{{ route('posts.show', $post->id) }}" 
                                               class="text-blue-600 hover:underline">📖 Xem</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function () {
            $('#postsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                language: {
                    search: "🔍 Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ bài viết",
                    info: "Hiển thị từ _START_ đến _END_ của _TOTAL_ bài viết",
                    paginate: {
                        previous: "⬅️",
                        next: "➡️"
                    },
                    emptyTable: "📭 Không có dữ liệu để hiển thị"
                }
            });
        });
    </script>
</body>
</html>
