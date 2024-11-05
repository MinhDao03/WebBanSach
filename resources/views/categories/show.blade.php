@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết danh mục</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Chỉnh sửa</a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
@endsection
