<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'title' => 'Bài Viết Kiểm Duyệt từ chối',
            'content' => 'Đây là nội dung của bài viết thử nghiệm đang chờ kiểm duyệt.',
            'status' => 'pending',
            'user_id' => 2, // Thay thế với ID của một user hợp lệ
        ]);
    }
}
