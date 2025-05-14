@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold">✏️ Chỉnh sửa thông tin cá nhân</h2>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label class="block font-semibold text-lg">Tên</label>
        <input type="text" name="name" value="{{ $user->name }}" class="border rounded w-full p-2" required>

        <label class="block font-semibold text-lg mt-4">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="border rounded w-full p-2" required>

        <button type="submit" class="btn btn-primary mt-4">💾 Cập nhật thông tin</button>
    </form>
</div>
@endsection