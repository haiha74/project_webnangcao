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
    <div class="features_items">
      <h2 class="title text-center">Danh Mục Game</h2>
      <div class="row">
        @foreach($categories as $cat)
          <div class="col-sm-3">
            <div class="product-image-wrapper">
              <div class="single-products">
                <div class="productinfo text-center">
                  <img src="{{ $cat['image'] }}" alt="{{ $cat['name'] }}" width="220" height="190" />
                  <h2>{{ $cat['name'] }}</h2>
                  <p>Tổng acc: {{ $cat['total'] }} - Đã bán: {{ $cat['sold'] }}</p>
                  <a href="#" class="btn btn-default add-to-cart">
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
                <a href="#" class="btn"><i class="fa fa-random"></i> Xem tất cả</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>

@endsection
