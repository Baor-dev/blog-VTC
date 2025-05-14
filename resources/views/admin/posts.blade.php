@extends('admin.dashboard')

@section('dashboard-content')
<div class="container">
    <h2 class="mb-4">📜 Kiểm Duyệt Bài Viết</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($posts->isEmpty())
        <p class="text-center text-muted fs-4 mt-4">📭 Không có bài viết đợi duyệt.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Tác giả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit(strip_tags($post->content), 100) }}</td>
                        <td>{{ optional($post->author)->name ?? 'Unknown Author' }}</td>
                        <td>
                            <form action="{{ route('admin.posts.approve', ['id' => $post->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">✅ Duyệt</button>
                            </form>
                            <form action="{{ route('admin.posts.reject', ['id' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="text" name="reason" placeholder="Lý do từ chối" required class="form-control mt-2">
                                <button type="submit" class="btn btn-danger mt-2">❌ Từ Chối</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection