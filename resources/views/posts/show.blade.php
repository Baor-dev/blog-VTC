<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    
    <!-- Custom CSS for smooth animation -->
    <style>
        body {
            scroll-behavior: smooth;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-relaxed">

    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden mt-6 fade-in">

        <!-- Banner -->
        <div class="relative h-80">
            <img src="{{ asset('storage/' . $post->banner_image) }}" class="w-full h-full object-cover" alt="Banner">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-end p-6">
                <h1 class="text-white text-4xl font-bold drop-shadow-lg">{{ $post->title }}</h1>
            </div>
        </div>

        <!-- Post Content -->
        <div class="px-10 py-8 text-gray-800 text-lg space-y-6 fade-in">
            <div class="prose max-w-none text-xl">
                {!! $post->content !!}
            </div>
            <p class="text-sm text-gray-500">📝 <strong>Tác giả:</strong> {{ optional($post->author)->name ?? 'Không xác định' }}</p>
        </div>

        <!-- Gallery -->
        @if($post->gallery_images)
            <div class="px-10 pb-10 fade-in">
                <h2 class="text-2xl font-bold text-green-700 mb-4">📸 Thư viện ảnh</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach(json_decode($post->gallery_images, true) as $image)
                        <a href="{{ asset('storage/' . $image) }}" 
                           data-lightbox="gallery" 
                           data-title="Ảnh chi tiết">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="Gallery" 
                                 class="w-full h-44 object-cover rounded shadow hover-scale">
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back -->
        <div class="px-10 pb-10 fade-in">
            <a href="{{ route('dashboard') }}" class="inline-block text-blue-600 hover:underline text-lg font-medium">
                ← Quay lại trang chủ
            </a>
        </div>
    </div>

    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>
