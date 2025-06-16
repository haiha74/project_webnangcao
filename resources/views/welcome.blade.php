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
