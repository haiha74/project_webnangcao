## 🕹️ **Website Bán Tài Khoản Game – ShopAccGame**

## 👨‍🎓 Thông tin sinh viên

- **Họ và tên:** Nguyễn Hải Hà  
- **Mã sinh viên:** 23010469  
- **Lớp:** K17-CNTT5 
- **Môn học:** Thiết kế Web nâng cao (TH3)
## 📄 Giới thiệu dự án
**ShopAccGame** là một website thương mại điện tử đơn giản chuyên bán các tài khoản game như PUBG, Liên Quân, Free Fire,... Dự án được phát triển bằng **Laravel Framework** với thiết kế hiện đại, dễ sử dụng và tích hợp các công nghệ phổ biến:

- **Tự xây hệ thống auth** – Viết tay chức năng đăng ký, đăng nhập, đăng xuất và phân quyền
- **Blade Template Engine** – Tạo bố cục và view tái sử dụng
- **Tailwind CSS** – Thiết kế giao diện responsive, hiện đại
- **Eloquent ORM** – Quản lý dữ liệu theo mô hình đối tượng
- **MySQL (Cloud – Aiven)** – Cơ sở dữ liệu lưu trực tuyến
- **Bảo mật hệ thống**:
  - Token CSRF – bảo vệ form
  - Session & Cookie – quản lý trạng thái đăng nhập
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
# Người dùng truy cập trang web khi đã đăng nhập
![image](https://github.com/user-attachments/assets/2498e6bf-6a28-456a-9e3c-afa697dbbe61)


# CRUD Sản phẩm (Admin)
![Screenshot 2025-06-19 010144](https://github.com/user-attachments/assets/f3db546f-7fe1-4141-84ab-b1bf1085fd93)


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
## View-Welcome
```
@extends('layouts.app')
@section('title', 'Trang chủ | SHOP ACC GAME')
@section('content')
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div id="heroCarousel" class="carousel slide mb-4" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#heroCarousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>

<!-- Danh Mục Game -->
    @php
        $links = [
            5 => '/acc-pubg',
            6 => '/acc-lien-quan',
            7 => '/acc-free-fire',
            8 => '/acc-lien-minh'
        ];
    @endphp

    <div class="features_items">
      <h2 class="title text-center">DANH MỤC GAME</h2>
      <div class="row">
        @foreach($categories as $index => $cat)
          <div class="col-sm-3">
            <div class="product-image-wrapper">
              <div class="single-products">
                <div class="productinfo text-center">
                  <img src="{{ asset('uploads/category/' . $cat->category_image) }}" alt="{{ $cat->category_name }}" style="max-width: 100%; height: 180px; object-fit: cover;">
                  <h4>{{ $cat->category_name }}</h4>

                  @if($index == 0)
                    <p>Tổng acc: 28120 - Đã bán: 24092</p>
                  @elseif($index == 1)
                    <p>Tổng acc: 23948 - Đã bán: 19384</p>
                  @elseif($index == 2)
                    <p>Tổng acc: 46284 - Đã bán: 39274</p>
                  @elseif($index == 3)
                    <p>Tổng acc: 36274 - Đã bán: 28365</p>
                  @else
                    <p>Tổng acc: 27361 - Đã bán: 19284</p>
                  @endif

                  <a href="{{ url($links[$cat->category_id] ?? '#') }}" class="btn btn-default add-to-cart">
                      <i class="fa fa-gamepad"></i> Xem tất cả
                  </a>

                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>


<!-- ================= DANH MỤC GAME RANDOM ================= -->
    <section class="features_items">
      <h2 class="title">Danh Mục Game Random</h2>
      <div class="row">
        @foreach ($randoms as $item)
          <div class="col-md-3 col-sm-6">
            <div class="card-category">
              <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
              <div class="card-body">
                <h5>{{ $item['name'] }}</h5>
                <p>Thử vận may: {{ $item['title'] }}</p>
                <p>Giá: {{ number_format($item['price']) }} VNĐ</p>
                <a href="{{ url('/random-out-stock') }}" class="btn"><i class="fa fa-random"></i> Xem tất cả</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>

@endsection
```

# 🔐Security Setup
**CSRF**
```
<form method="POST" action="/login">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" required>

            <button type="submit">Đăng nhập</button>
        </form>
```
**Chống XSS. Ví dụ : order.blade.php**
```
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
```
**SQL Injection. Ví dụ AccountGameController**
```
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
```
**Session & Cookie**
```
Route::get('/lich-su-mua-hang', [OrderController::class, 'lichSu'])->name('lich-su-mua-hang')->middleware('auth');
Route::post('/xac-nhan-mua-hang', [OrderController::class, 'xuLyMuaHang'])
    ->middleware('auth')
    ->name('xu-ly-mua-hang');
```
# Link
## Link Demo : Youtube link : https://youtu.be/_gs9mg6kN3w
## Link Demo : Github link : https://github.com/haiha74/project_webnangcao.git
## Link Github page : [https://haiha74.github.io/project_webnangcao/](https://haiha74.github.io/project_webnangcao/)

## Public Web (deployment) link: 

# Một số hình ảnh chức năng chính
## Trang đăng nhập , đăng kí
![image](https://github.com/user-attachments/assets/4a6abc8c-b0de-4153-8850-aa63d84e00f6)
![image](https://github.com/user-attachments/assets/acc29781-af1d-43da-991f-e53e1301acb3)
## Trang chủ
![image](https://github.com/user-attachments/assets/44c3b06b-5d9d-4123-8a40-23fa3d0a0688)
## Trang sản phẩm
![image](https://github.com/user-attachments/assets/6ff142f1-c075-42d4-856d-c81a870e31e8)
## Trang lịch sử mua hàng
![image](https://github.com/user-attachments/assets/5c1b2b45-6856-4f28-aa43-afdbc7854db3)
## Trang đăng nhập Admin
![image](https://github.com/user-attachments/assets/7bec1a4d-e67c-472e-a466-5fedfa9ba2a5)
## Trang quản lí đơn hàng
![image](https://github.com/user-attachments/assets/c5d4cd87-4a0c-41c5-b6a2-20efb88f8de6)
## Trang CRUD Account
![image](https://github.com/user-attachments/assets/3d5e846c-acb5-4ca4-af35-f699830210bc)


# License & Copy Rights
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
