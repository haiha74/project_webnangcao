<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $categories = DB::table('tbl_category_game')
        ->where('category_status', 1)
        ->get();

        $randoms = [
            ['name' => 'LQ giá 7K', 'title' => 'Thử vận may liên quân giá rẻ', 'price' => 7000, 'image' => '/frontend/images/random7k.jpg'],
            ['name' => 'LQ giá 25K', 'title' => 'Thử vận may liên quân 70K', 'price' => 25000, 'image' => '/frontend/images/random25k.jpg'],
            ['name' => 'LQ giá 50K', 'title' => 'Thử vận may liên quân cao cấp', 'price' => 50000, 'image' => '/frontend/images/random50k.jpg'],
            ['name' => 'LQ giá 70K', 'title' => 'Thử vận may liên quân vip', 'price' => 70000, 'image' => '/frontend/images/random70k.jpg'],
        ];

        return view('welcome', compact('categories', 'randoms'));

    }
} 