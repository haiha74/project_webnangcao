@extends('layouts.app')
@section('title', 'Nạp tiền')

@section('content')
<div class="container text-center">
    <h2 class="my-4">Nạp tiền bằng QR Code</h2>
    <p>Vui lòng quét mã QR bên dưới để nạp tiền vào tài khoản:</p>

    <img src="{{ asset('/backend/images/qr_momo.jpg') }}" alt="QR MoMo" style="max-width: 300px; margin: 20px auto;">

    <p><strong>Người nhận:</strong> Nguyễn Hải Hà</p>
    <p><strong>Số điện thoại:</strong> 0342075321</p>
    <p><strong>Nội dung chuyển khoản:</strong> nap_tien_taikhoan_{{ Auth::user()->id ?? 'id' }}</p>

    <hr>

    <!-- THÔNG BÁO -->
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <h5 class="mt-4">Nhập số tiền bạn đã chuyển:</h5>
    <form method="POST" action="{{ route('gui-yeu-cau-nap') }}" class="mt-3">
        @csrf
        <div class="mb-3 w-50 mx-auto">
            <input type="number" name="amount" class="form-control" placeholder="Nhập số tiền (VNĐ)" required min="1000">
        </div>
        <button type="submit" class="btn btn-primary">Gửi yêu cầu nạp</button>
    </form>
</div>
@endsection
