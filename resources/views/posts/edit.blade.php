<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Bài Viết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-green-100">
    <div class="max-w-4xl mx-auto px-6 py-10 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-green-700 mb-6">✏️ Chỉnh Sửa Bài Viết</h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <input type="hidden" name="delete_images" id="deleteImages">
            <input type="hidden" name="delete_banner" id="deleteBanner">

            <!-- Title -->
            <label class="block font-semibold text-lg">Tiêu đề</label>
            <input type="text" name="title" value="{{ $post->title }}" class="border rounded w-full p-2" required>

            <!-- Short Description -->
            <label class="block font-semibold text-lg mt-4">Mô tả ngắn</label>
            <textarea name="short_description" class="border rounded w-full p-2">{{ $post->short_description }}</textarea>

            <!-- Content (WYSIWYG Editor) -->
            <label class="block font-semibold text-lg mt-4">Nội dung bài viết</label>
            <textarea name="content" id="wysiwyg-editor" class="border rounded w-full p-2">{{ $post->content }}</textarea>

            <!-- Banner Image -->
            <label class="block font-semibold text-lg mt-4">Banner bài viết</label>
            <input type="file" name="banner_image" accept="image/*" class="border rounded w-full p-2">

            @if($post->banner_image)
                <p class="text-gray-600 mt-2">Ảnh hiện tại:</p>
                <div class="relative w-full max-w-xs banner-container">
                    <img src="{{ asset('storage/' . $post->banner_image) }}" class="w-full rounded shadow-md">
                </div>
            @endif

            <!-- Gallery Images -->
            <label class="block font-semibold text-lg mt-4">Thư viện ảnh</label>
            <input type="file" name="gallery_images[]" multiple accept="image/*" class="border rounded w-full p-2">

            @if($post->gallery_images)
                <p class="text-gray-600 mt-2">Ảnh hiện tại:</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(json_decode($post->gallery_images, true) as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image) }}" class="w-full rounded shadow-md">
                            
                            <!-- Transparent Delete Icon -->
                            <button type="button" onclick="markImageForDeletion('{{ $image }}', this)" 
                                class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                X
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Buttons -->
            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md shadow-md transition-all duration-200">
                    💾 Cập nhật bài viết
                </button>
                <a href="{{ route('profile') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-md shadow-md transition-all duration-200">
                    ❌ Hủy Bỏ
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.tiny.cloud/1/glg56wcc6b000oivlzfldfgrsett7az2up18wqk3d5vf0cqh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#wysiwyg-editor',
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent'
        });

        let imagesToDelete = [];

        function markImageForDeletion(imagePath, element) {
            imagesToDelete.push(imagePath);
            element.parentElement.remove();
        }

        function deleteBanner() {
            document.getElementById("deleteBanner").value = "1"; // Mark banner for deletion
            document.querySelector(".banner-container").remove(); // Hide banner visually
        }

        document.querySelector("form").addEventListener("submit", function() {
            document.getElementById("deleteImages").value = JSON.stringify(imagesToDelete);
        });
    </script>
</body>
</html>