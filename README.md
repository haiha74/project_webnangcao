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
![image](https://github.com/user-attachments/assets/3ffa623c-d000-4669-a8f3-bbb2a74c20b3)

## Sơ đồ thuật toán
# Đăng nhập/Đăng ký
![image](https://github.com/user-attachments/assets/1f8e9cf9-660d-419b-a056-3f87ae402d66)

# CRUD Sản phẩm (Admin)
![Screenshot 2025-06-19 010144](https://github.com/user-attachments/assets/f3db546f-7fe1-4141-84ab-b1bf1085fd93)



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
## Model-Account
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'tbl_account';
    protected $primaryKey = 'account_id';
    public $timestamps = false;

    protected $fillable = [
        'account_name',
        'account_price',
        'account_desc',
        'account_content',
        'category_id',
        'account_status',
        'account_image',
    ];
}
```
## Model-User
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

 
    public function depositRequests()
    {
        return $this->hasMany(DepositRequest::class);
    }
}
```
## OrderController
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
## AccountGameController
```
<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Account;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class AccountGameController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if (!$admin_id) {
            return Redirect::to('admin')->send();
        }
    }

    public function add_account (){
        $this->Authlogin();
        $cate_game = DB::table('tbl_category_game')->orderby('category_id','desc')->get();

        return view('admin.add_account')->with('cate_game', $cate_game);
    }

    public function all_account (){
        $this->Authlogin();
        $all_account = DB::table('tbl_account')->orderby('account_id', 'desc')->get();
        $manager_account = view('admin.all_account')->with('all_account', $all_account);
        return view('admin_layout')->with('admin.all_account', $manager_account);
    }

    public function save_account(Request $request){
        $this->Authlogin();
        $data = array();
        $data['account_name'] = $request->account_name;
        $data['account_price'] = $request->account_price;
        $data['account_desc'] = $request->account_desc;
        $data['account_content'] = $request->account_content;
        $data['category_id'] = $request->account_cate;
        $data['account_status'] = $request->account_status;
        $data['account_image'] = $request->account_image;

        $get_image = $request->file('account_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/account', $new_image);
            $data['account_image'] = $new_image;
        }

        DB::table('tbl_account')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function edit_account($account_id){
        $this->Authlogin();
        $cate_game = DB::table('tbl_category_game')->orderby('category_id', 'desc')->get();
        $edit_account = DB::table('tbl_account')->where('account_id', $account_id)->first();

        $manager_account = view('admin.edit_account')
            ->with('edit_account', $edit_account)
            ->with('cate_game', $cate_game);

        return view('admin_layout')->with('admin.edit_account', $manager_account);
    }

    public function unactive_account($account_id){
        $this->Authlogin();
        DB::table('tbl_account')->where('account_id', $account_id)->update(['account_status' => 1]);
        Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function active_account($account_id){
        $this->Authlogin();
        DB::table('tbl_account')->where('account_id', $account_id)->update(['account_status' => 0]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function update_account(Request $request, $account_id){
        $this->Authlogin();
        $data = array();
        $data['account_name'] = $request->account_name;
        $data['account_price'] = $request->account_price;
        $data['account_desc'] = $request->account_desc;
        $data['account_content'] = $request->account_content;
        $data['category_id'] = $request->account_cate;
        $data['account_status'] = $request->account_status;

        $get_image = $request->file('account_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/account', $new_image);
            $data['account_image'] = $new_image;
        }

        DB::table('tbl_account')->where('account_id', $account_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function delete_account($account_id){
        $this->Authlogin();
        DB::table('tbl_account')->where('account_id', $account_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function details_account($account_id){
        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $details_account = DB::table('tbl_account')
            ->join('tbl_category_game', 'tbl_category_game.category_id', '=', 'tbl_account.category_id')
            ->where('tbl_account.account_id', $account_id)
            ->get();

        return view('pages.sanpham.show_details')
            ->with('category', $cate_game)
            ->with('account_details', $details_account);
    }


    //SHOW ACCOUNT
    public function acc_pubg(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 5)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_pubg')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function acc_lienquan(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 6)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_lienquan')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function acc_freefire(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 7)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_freefire')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function acc_lienminh(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 8)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_lienminh')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function xuLyMuaHang(Request $request){
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Bạn cần đăng nhập để mua hàng');
        }

        $account = Account::find($request->account_id);
        if (!$account) {
            return back()->with('error', 'Tài khoản không tồn tại');
        }

        \App\Models\Order::create([
            'user_id'       => Auth::id(),
            'account_id'    => $account->account_id,
            'account_name'  => $account->account_name,
            'account_desc'  => $account->account_desc,
            'account_price' => $account->account_price,
        ]);

        $account->delete();
        return redirect('/lich-su-mua-hang')->with('success', 'Mua hàng thành công, vui lòng kiểm tra LỊCH SỬ MUA HÀNG để nhận sản phẩm');
    }

}
```
## AdminController
```
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if (!$admin_id) {
            return Redirect::to('admin')->send();
    }
}

    public function index(){
       
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->Authlogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $this->Authlogin();
        $admin_email =  $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();

    if($result){
            Session::put('admin_name' ,$result->admin_name);
            Session::put('admin_id' ,$result->admin_id);
            return Redirect::to('/dashboard');
        
        }else{
            
            Session::put('message' ,'Mật khẩu hoặc tài khoản bị sai. Vui lòng nhập lại!');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->Authlogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    
    }
    
    public function lichSuBanHang() {
    $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
    return view('admin.order_history', compact('orders'));
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
## Migration - Bảng User
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```
## Migration - Bảng Account
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration

{
    public function up(): void
    {
        Schema::create('tbl_account', function (Blueprint $table) {
            $table->increments('account_id');
            $table->string('account_name');
            $table->string('account_price');
            $table->text('account_desc');
            $table->text('account_content');
            $table->string('account_image');
            $table->integer('category_id');
            $table->integer('account_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_account');
    }
}
```
## Migration - Bảng Category
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tbl_category_game', function (Blueprint $table) {
            $table->Increments('category_id');
            $table->string('category_name');
            $table->text('category_desc');
            $table->integer('category_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_category_game');
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
