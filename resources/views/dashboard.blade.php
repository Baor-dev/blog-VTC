<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Bài Viết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-green-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-green-700">📜 Danh Sách Bài Viết</h2>

            <div class="flex gap-4">
                <!-- Admin Panel Button (Only for Admins) -->
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" 
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition-all duration-200 ease-in-out">
                        🔧 Admin Panel
                    </a>
                @endif

                <!-- Create Post Button -->
                <a href="{{ route('posts.create') }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition-all duration-200 ease-in-out">
                    ✍️ Tạo Bài Viết
                </a>

                <!-- My Account Button -->
                <a href="{{ route('profile') }}" 
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md shadow-md transition-all duration-200 ease-in-out">
                    🧑‍💼 Tài khoản của tôi
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition-all duration-200 ease-in-out">
                        🚪 Đăng Xuất
                    </button>
                </form>
            </div>
        </div>

        <!-- Post Container -->
        <div class="mt-6 bg-white shadow-md rounded-lg p-6">
            @if ($posts->isEmpty())
                <p class="text-gray-600 text-center text-lg">📭 Không có bài viết nào.</p>
            @else
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        @if ($post->status === 'approved') <!-- ✅ Only show approved posts -->
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                                <!-- Banner Image -->
                                <img src="{{ asset('storage/' . $post->banner_image) }}" alt="Banner"
                                    class="w-full h-48 object-cover rounded-t-lg">
                                
                                <div class="p-5">
                                    <!-- Title -->
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary"><h3 class="text-xl font-bold text-green-700">{{ $post->title }}</h3></a>

                                    <!-- Short Description -->
                                    <p class="text-gray-600 mt-2">{{ Str::limit($post->short_description, 100) }}</p>

                                    <!-- Author -->
                                    <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                                        <span>📝 {{ optional($post->author)->name ?? 'Không xác định' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>
</html>