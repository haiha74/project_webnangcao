@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Lịch sử mua hàng</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên tài khoản</th>
                    <th>Mô tả</th>
                    <th>Thông tin đăng nhập tài khoản</th>
                    <th>Giá</th>
                    <th>Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->account_name }}</td>
                        <td>{{ $order->account_desc }}</td>
                        <td>{{ $order->account_content }}</td>
                        <td>{{ number_format($order->account_price) }} VNĐ</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @else
        <p>Bạn chưa mua đơn hàng nào.</p>
    @endif
</div>
@endsection
