<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryGame;


Route::get('/', [HomeController::class, 'index']);

//backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);

//DANH MUC GAME
Route::get('/them-tai-khoan-vao-danh-muc-game', [CategoryGame::class, 'them_tai_khoan_vao_danh_muc_game']);
Route::get('/tat-ca-tai-khoan-danh-muc-game', [CategoryGame::class, 'tat_ca_tai_khoan_danh_muc_game']);
Route::get('/sua-tai-khoan-danh-muc-game/{category_game_id}', [CategoryGame::class, 'sua_tai_khoan_danh_muc_game']);
Route::get('/xoa-tai-khoan-danh-muc-game/{category_game_id}', [CategoryGame::class, 'xoa_tai_khoan_danh_muc_game']);
Route::post('/luu-category-game', [CategoryGame::class, 'save_category_game']);
Route::post('/update-category-game/{category_game_id}', [Categorygame::class, 'update_category_game']);