@extends('admin.dashboard')

@section('dashboard-content')
<div class="min-h-screen bg-white py-12">
    <div class="bg-white border border-gray-300 p-8 rounded-lg shadow-xl max-w-6xl w-full mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">👤 Quản lý Người Dùng</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-400 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-400 rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-gray-800 border border-gray-300 text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b">Tên</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Vai trò</th>
                        <th class="py-2 px-4 border-b">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('admin.users.updateRole', ['id' => $user->id]) }}" method="POST" class="flex items-center justify-center space-x-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="bg-white text-gray-800 p-2 border border-gray-300 rounded-lg">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Người Dùng</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Quản Trị Viên</option>
                                    </select>
                                    <button type="submit" class="text-blue-600 underline hover:text-blue-800 hover:font-semibold transition duration-150">
                                        Cập nhật
                                    </button>
                                </form>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 underline hover:text-red-800 hover:font-semibold transition duration-150">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
