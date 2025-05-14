<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Bài Viết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-green-100">
    <div class="max-w-4xl mx-auto px-6 py-10 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-green-700 mb-6">✍️ Tạo Bài Viết Mới</h2>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <label class="block font-semibold text-lg">Tiêu đề</label>
        <input type="text" name="title" class="border rounded w-full p-2" required>

        <!-- Short Description -->
        <label class="block font-semibold text-lg mt-4">Mô tả ngắn</label>
        <textarea name="short_description" class="border rounded w-full p-2"></textarea>

        <!-- Content (WYSIWYG Editor) -->
        <label class="block font-semibold text-lg mt-4">Nội dung bài viết</label>
        <textarea name="content" id="wysiwyg-editor" class="border rounded w-full p-2"></textarea>

        <!-- Banner Image -->
        <label class="block font-semibold text-lg mt-4">Banner bài viết</label>
        <input type="file" name="banner_image" accept="image/*" class="border rounded w-full p-2">

        <!-- Gallery Images -->
        <label class="block font-semibold text-lg mt-4">Thư viện ảnh</label>
        <input type="file" name="gallery_images[]" multiple accept="image/*" class="border rounded w-full p-2">

        <!-- Buttons -->
        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md shadow-md transition-all duration-200">
                🚀 Đăng bài viết
            </button>
            <a href="{{ route('dashboard') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-md shadow-md transition-all duration-200">
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
    </script>
</body>
</html>