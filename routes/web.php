<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryGame;
use App\Http\Controllers\AccountGameController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;

//Home
Route::get('/', [HomeController::class, 'index']);

//ADMIN
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::get('/admin/lich-su-ban-hang', [App\Http\Controllers\AdminController::class, 'lichSuBanHang'])->name('admin.lich-su-ban-hang');
Route::get('/admin/deposit-requests', [DepositController::class, 'index']);
Route::post('/admin/deposit-approve/{id}', [DepositController::class, 'approve']);
Route::get('/admin/duyet-nap', [TopupController::class, 'danhSach'])->middleware(['auth', 'admin']);



//Danh muc game
Route::get('/them-tai-khoan-vao-danh-muc-game', [CategoryGame::class, 'them_tai_khoan_vao_danh_muc_game']);
Route::get('/tat-ca-tai-khoan-danh-muc-game', [CategoryGame::class, 'tat_ca_tai_khoan_danh_muc_game']);
Route::get('/sua-tai-khoan-danh-muc-game/{category_game_id}', [CategoryGame::class, 'sua_tai_khoan_danh_muc_game']);
Route::get('/xoa-tai-khoan-danh-muc-game/{category_game_id}', [CategoryGame::class, 'xoa_tai_khoan_danh_muc_game']);
Route::post('/luu-category-game', [CategoryGame::class, 'luu_category_game']);
Route::post('/capnhat-category-game/{category_game_id}', [Categorygame::class, 'capnhat_category_game']);
Route::get('/unactive-category-game/{category_game_id}', [Categorygame::class, 'unactive_category_game']);
Route::get('/active-category-game/{category_game_id}', [Categorygame::class, 'active_category_game']);

//Account Game
Route::get('/add-account', [AccountGameController::class, 'add_account']);
Route::post('/save-account', [AccountGameController::class, 'save_account']);
Route::get('/all-account', [AccountGameController::class, 'all_account']);
Route::get('/edit-account/{account_id}', [AccountGameController::class, 'edit_account']);
Route::post('/update-account/{account_id}', [AccountGameController::class, 'update_account']);
Route::get('/delete-account/{account_id}', [AccountGameController::class, 'delete_account']);
Route::get('/unactive-account/{account_id}', [AccountGameController::class, 'unactive_account']);
Route::get('/active-account/{account_id}', [AccountGameController::class, 'active_account']);

//SHOW ACC
Route::get('/acc-pubg', [AccountGameController::class, 'acc_pubg']);
Route::get('/acc-lien-quan', [AccountGameController::class, 'acc_lienquan']);
Route::get('/acc-free-fire', [AccountGameController::class, 'acc_freefire']);
Route::get('/acc-lien-minh', [AccountGameController::class, 'acc_lienminh']);

//Khi het acc
Route::get('/random-out-stock', function () {
    return view('pages.category.out_of_stock');
});


//User
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
});


//Order
//Route::post('/xac-nhan-mua-hang', [OrderController::class, 'xuLyMuaHang'])->name('xu-ly-mua-hang');
Route::get('/lich-su-mua-hang', [OrderController::class, 'lichSu'])->name('lich-su-mua-hang')->middleware('auth');
Route::post('/xac-nhan-mua-hang', [OrderController::class, 'xuLyMuaHang'])
    ->middleware('auth')
    ->name('xu-ly-mua-hang');


//Nap tien
Route::get('/nap-tien', function () {
    return "
    <div style='text-align:center; margin-top:50px; font-family: Arial, sans-serif;'>
        <h2>🚧 Tính năng đang được phát triển, vui lòng chờ đợi! 🚧</h2>
        <a href='/' style='
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff3d00;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        '>⬅️ Về trang chủ</a>
    </div>
    ";
});





