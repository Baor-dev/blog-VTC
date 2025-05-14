<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Show the post creation form
    public function create()
    {
        return view('posts.create'); // Ensure this matches the Blade file
    }

    // Store the post in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->short_description = $request->short_description;
        $post->content = $request->content;
        $post->status = 'pending'; // Default to "pending"
        $post->user_id = Auth::id();

        // Handle banner image
        if ($request->hasFile('banner_image')) {
            $post->banner_image = $request->file('banner_image')->store('uploads/posts', 'public');
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $images = [];
            foreach ($request->file('gallery_images') as $image) {
                $images[] = $image->store('uploads/posts/gallery', 'public');
            }
            $post->gallery_images = json_encode($images);
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Bài viết đã được gửi và đang chờ phê duyệt!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('profile')->with('success', 'Bài viết đã được xóa thành công!');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update text fields
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'pending'
        ]);

        // 🔥 Overwrite existing banner if a new one is uploaded
        if ($request->hasFile('banner_image')) {
            Storage::delete('public/' . $post->banner_image); // Delete old banner
            $post->banner_image = $request->file('banner_image')->store('banners', 'public');
        }

        // 🔥 Remove gallery images marked for deletion
        if ($request->has('delete_images')) {
            $imagesToDelete = json_decode($request->delete_images, true);
            $existingImages = json_decode($post->gallery_images, true) ?? [];

            foreach ($imagesToDelete as $image) {
                Storage::delete('public/' . $image);
                $existingImages = array_diff($existingImages, [$image]); // Remove from database list
            }

            $post->gallery_images = json_encode($existingImages);
        }

        // 🔥 Process new gallery image uploads
        if ($request->hasFile('gallery_images')) {
            $newImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $newImages[] = $image->store('gallery', 'public');
            }

            $existingImages = json_decode($post->gallery_images, true) ?? [];
            $post->gallery_images = json_encode(array_merge($existingImages, $newImages)); // Combine old & new images
        }

        $post->save();

        return redirect()->route('profile')->with('success', 'Bài viết đã được cập nhật!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}