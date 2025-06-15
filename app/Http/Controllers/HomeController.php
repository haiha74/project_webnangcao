<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        $categories = [
            ['name' => 'PUBG MOBILE', 'image' => '/frontend/images/pubg.gif', 'total' => 28120, 'sold' => 24092],
            ['name' => 'LIÊN QUÂN', 'image' => '/frontend/images/lienquan.gif', 'total' => 12340, 'sold' => 7011],
            ['name' => 'FREE FIRE', 'image' => '/frontend/images/freefire.gif', 'total' => 70120, 'sold' => 84092],
            ['name' => 'LIÊN MINH HUYỀN THOẠI', 'image' => '/frontend/images/lienminh.gif', 'total' => 73340, 'sold' => 67011],
        ];

        $randoms = [
            ['name' => 'LQ giá 7K', 'title' => 'Thử vận may liên quân giá rẻ', 'price' => 7000, 'image' => '/frontend/images/random7k.jpg'],
            ['name' => 'LQ giá 25K', 'title' => 'Thử vận may liên quân 70K', 'price' => 25000, 'image' => '/frontend/images/random25k.jpg'],
            ['name' => 'LQ giá 50K', 'title' => 'Thử vận may liên quân cao cấp', 'price' => 50000, 'image' => '/frontend/images/random50k.jpg'],
            ['name' => 'LQ giá 70K', 'title' => 'Thử vận may liên quân vip', 'price' => 70000, 'image' => '/frontend/images/random70k.jpg'],
        ];

        return view('welcome', compact('categories', 'randoms'));

    }
}
