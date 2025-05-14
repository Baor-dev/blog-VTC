<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class AdminUserController extends Controller
{
    // ✅ Display User List with Search & Pagination
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard'); // Redirect non-admins
        }

        $query = User::query();

        // ✅ Enable Search Functionality (Name & Email)
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10); // ✅ Paginate 10 users per page
        $totalUsers = User::count(); // ✅ Pass Total Users to View

        return view('admin.users', compact('users', 'totalUsers'));
    }

    // ✅ Update User Role with Security Checks
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,user,moderator', // ✅ Validate role updates
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Vai trò đã được cập nhật!');
    }

    // ✅ Delete User (Prevent Self-Deletion)
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'Bạn không thể xóa chính mình!');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}