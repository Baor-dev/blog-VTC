@extends('admin.dashboard')

@section('dashboard-content')
    <h2>User Management</h2>
    <table>
        <tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
            </tr>
        @endforeach
    </table>
@endsection