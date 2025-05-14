<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'posts' => Post::paginate(10)
        ]);
    }
}