<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function stats()
    {
        return view('admin.stats', [
            'totalUsers' => User::count(),
            'totalPosts' => Post::count(),
            'pendingPosts' => Post::where('status', 'pending')->count(),
            'approvedPosts' => Post::where('status', 'approved')->count(),
            'latestUsers' => User::latest()->limit(5)->get(),
            'latestPosts' => Post::latest()->limit(5)->get(),
        ]);
    }
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'pendingPosts' => Post::where('status', 'pending')->count(),
            'approvedPosts' => Post::where('status', 'approved')->count(),
            'recentPosts' => Post::latest()->limit(5)->get(),
        ]);
    }

}