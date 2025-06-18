## 🕹️ **Website Bán Tài Khoản Game – ShopAccGame**

## 👨‍🎓 Thông tin sinh viên

- **Họ và tên:** Nguyễn Hải Hà  
- **Mã sinh viên:** 23010469  
- **Lớp:** K17-CNTT5 
- **Môn học:** Thiết kế Web nâng cao (TH3)
## 📄 Giới thiệu dự án
**ShopAccGame** là một website thương mại điện tử đơn giản chuyên bán các tài khoản game như PUBG, Liên Quân, Free Fire,... Dự án được phát triển bằng **Laravel Framework** với thiết kế hiện đại, dễ sử dụng và tích hợp các công nghệ phổ biến:

- **Laravel Breeze** – Đăng ký / đăng nhập người dùng và phân quyền cơ bản
- **Blade Template Engine** – Tạo bố cục và view tái sử dụng
- **Tailwind CSS** – Thiết kế giao diện responsive, hiện đại
- **Eloquent ORM** – Quản lý dữ liệu theo mô hình đối tượng
- **MySQL (Cloud – Aiven)** – Cơ sở dữ liệu lưu trực tuyến
- **Bảo mật hệ thống**:
  - Token CSRF – bảo vệ form
  - Session & Cookie – quản lý trạng thái đăng nhập
  - Validation – kiểm tra dữ liệu đầu vào
  - Phòng chống **SQL Injection** & **XSS**

Người dùng có thể duyệt danh sách tài khoản game, thêm vào giỏ hàng và tiến hành thanh toán sau khi đăng nhập. Quản trị viên có thể đăng nhập vào hệ thống để thực hiện các thao tác **thêm / sửa / xóa sản phẩm và đơn hàng**.

## 🧩 Chức năng chính

### 👤 Người dùng
- Đăng ký và đăng nhập
- Duyệt danh sách tài khoản game
- Thanh toán đơn hàng
- Xem lịch sử mua hàng

### 🛠 Quản trị viên (Admin)
- Đăng nhập riêng để quản trị
- CRUD sản phẩm game (tài khoản)
- Quản lý đơn hàng và người dùng

## 🛠️ Công nghệ sử dụng

| **Công nghệ**             | **Mô tả**                                      |
|---------------------------|-----------------------------------------------|
| Laravel (PHP)             | Backend framework chính                       |
| Tự xây hệ thống auth      | Viết tay chức năng đăng ký, đăng nhập, đăng xuất và phân quyền       |
| Blade + Tailwind CSS      | Giao diện người dùng, responsive và hiện đại  |
| MySQL (Aiven)             | Cơ sở dữ liệu lưu trữ trên nền tảng cloud     |
| Eloquent ORM              | Truy vấn và xử lý dữ liệu theo mô hình OOP    |
| Middleware                | Bảo vệ CSRF, phân quyền truy cập              |

# 🧩 Sơ đồ hệ thống website
# Sơ đồ khối
![image](https://github.com/user-attachments/assets/ecc7353b-de95-4c1c-ae5f-896169911f18)




## Sơ đồ chức năng

Class Diagram of Objects

## Sơ đồ thuật toán

Create Cart (user / car /user-car)
Activity Diagram

Edit Cart
Activity Diagram

Delete Cart

Activity Diagram

Authentication/Authorisation


# Một số Code chính minh họa

## Model-Order
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'payment_method',
        'total_amount',
        'status',
    ];
}
```
## Controller-Order
```
<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function xuLyMuaHang(Request $request)
    {
        $account = Account::find($request->account_id);
        if (!$account) {
            return back()->with('error', 'Không tìm thấy tài khoản');
        }

        Order::create([
            'user_id' => Auth::id(),
            'account_id' => $account->account_id,
            'account_name' => $account->account_name,
            'account_desc' => $account->account_desc,
            'account_content' => $account->account_content,
            'account_price' => $account->account_price,
        ]);

        $account->delete();

        return redirect()->route('lich-su-mua-hang')->with('success', 'Mua hàng thành công, vui lòng kiểm tra lịch sử mua hàng.');
    }

    public function lichSu()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('pages.history.orders', compact('orders'));
    }
}
```
## Migration - Bảng Order
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_id');
            $table->string('account_name');
            $table->text('account_desc')->nullable();
            $table->string('account_price');
            $table->timestamps();
        });
    }
};
```
## View-Lịch sử mua hàng
```
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
```
Phương thức CRUD

## View
blade template Cart

# Security Setup

# Link
## Link Demo : Youtube link
## Public Web (deployment) link: 

# Một số hình ảnh chức năng chính






# License & Copy Rights
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
