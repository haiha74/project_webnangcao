@extends('layouts.app')
@section('title', 'Hết hàng')
@section('content')

<div class="container text-center my-5">
    <h2 class="text-danger">Sản phẩm đã hết</h2>
    <p>Hiện tại danh mục này không còn tài khoản nào để hiển thị.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">
        Quay lại trang chủ
    </a>
</div>

@endsection
