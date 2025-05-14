<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    public function index() {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard'); // Redirect non-admins
        }

        $posts = Post::where('status', 'pending')->get(); // Get pending posts
        return view('admin.posts', compact('posts'));
    }

    public function approve($id) {
        $post = Post::findOrFail($id);
        $post->status = 'approved';
        $post->save();

        return redirect()->route('admin.posts')->with('success', 'Bài viết đã được duyệt!');
    }

    public function reject(Request $request, $id) {
        $post = Post::findOrFail($id);
        $post->status = 'rejected';
        $post->rejection_reason = $request->input('rejection_reason'); // Store reason
        $post->save();

        return redirect()->route('admin.posts')->with('error', 'Bài viết đã bị từ chối!');
    }
}
