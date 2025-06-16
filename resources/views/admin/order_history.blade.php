@extends('admin_layout')
@section('admin_content')
<div class="container">
    <h2>Thông tin tài khoản đã bán</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên tài khoản</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Người mua</th>
                <th>Email</th>
                <th>Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->account_name }}</td>
                    <td>{{ $order->account_desc }}</td>
                    <td>{{ number_format($order->account_price) }} VNĐ</td>
                    <td>{{ $order->user->name ?? 'Không xác định' }}</td>
                    <td>{{ $order->user->email ?? 'Không xác định' }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
