@extends('layouts.app')
@section('title', 'Tài khoản Liên Quân')
@section('content')

<div class="container">
    <h2 class="text-center mb-4">Danh sách tài khoản FREE FIRE</h2>
    <div class="row justify-content-center">
        @foreach($accounts as $acc)
            <div class="col-md-3 col-sm-6 text-center mb-4">
                <div style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; box-shadow: 0 0 8px rgba(0,0,0,0.05);">
                    <img 
                        src="{{ asset('uploads/account/' . $acc->account_image) }}" 
                        alt="{{ $acc->account_name }}" 
                        style="width: 100%; max-width: 180px; height: auto; object-fit: cover; margin-bottom: 10px;"
                    >
                    <h5>{{ $acc->account_name }}</h5>
                    <p>Giá: {{ number_format($acc->account_price) }} VNĐ</p>
                    <p>{{ $acc->account_desc }}</p>
                    <button 
                        class="btn btn-danger btn-sm"
                        onclick="showModal('{{ $acc->account_name }}', '{{ number_format($acc->account_price) }}', '{{ $acc->account_id }}')"
                    >
                        Mua ngay
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- MODAL XÁC NHẬN -->
<div id="orderModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.4); z-index:999;">
  <div style="background-color:#fff; max-width:500px; margin:10% auto; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.2);">
    <h4>Xác nhận đơn hàng</h4>
    <p style="color:green;">Vui lòng xác nhận các thông tin sau:</p>
    <p><strong>Mặt hàng:</strong> <span id="modalItemName" style="background:orange; padding:4px 8px;"></span></p>
    <p>Số lượng: <strong>1</strong></p>
    <p>Tổng tiền: <strong><span id="modalTotal"></span> VNĐ</strong></p>
    <p>Giảm giá: <strong>0</strong></p>
    <p>Tổng thanh toán: <strong><span id="modalTotalFinal"></span> VNĐ</strong></p>
    <form method="POST" action="{{ route('xu-ly-mua-hang') }}">
        @csrf
        <input type="hidden" name="account_id" id="modalAccountId">
        <button type="submit" class="btn btn-success">Mua hàng</button>
    </form>
    <button type="button" onclick="closeModal()" class="btn btn-secondary">Đóng</button>
  </div>
</div>

<script>
    function showModal(name, price, account_id) {
        document.getElementById('modalItemName').innerText = name;
        document.getElementById('modalTotal').innerText = price;
        document.getElementById('modalTotalFinal').innerText = price;
        document.getElementById('modalAccountId').value = account_id;
        document.getElementById('orderModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('orderModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target.id === "orderModal") {
            closeModal();
        }
    }
</script>

@endsection
