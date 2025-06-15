<style>
/* ===== HEADER CLEAN STYLE ===== */

header {
  font-family: 'Roboto', sans-serif;
  background-color: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}

/* Top bar */
.header-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 40px;
  border-bottom: 1px solid #eee;
  font-size: 14px;
  color: #555;
}

.header-top .social-icons a {
  color: #666;
  margin-right: 12px;
  transition: color 0.3s;
}

.header-top .social-icons a:hover {
  color: #111;
}

.header-top .hotline {
  font-weight: 500;
}
.header-top .hotline span {
  color: #999;
  font-size: 13px;
  margin-left: 4px;
}

/* Middle header */
.header-middle {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  background-color: #fff;
  border-bottom: 1px solid #eee;
}

/* Logo */
.header-middle .logo {
  margin-left: 200px;
}

.header-middle .logo img {
  height: 100px;
  object-fit: contain;
}


/* Navigation */
.navbar {
  display: flex;
  align-items: center;
  gap: 20px;
  height: 100%;
}

.navbar a {
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 650;
  font-size: 17px;
  color: #333;
  text-decoration: none;
  text-transform: uppercase;
  height: 40px;
  padding: 0 12px;
  border-radius: 6px;
  transition: 0.3s ease;
}

.navbar a:hover {
  background-color: #f44336;
  color: white;
}

/* Auth buttons */
.auth-buttons {
  display: flex;
  gap: 10px;
}

.auth-buttons a {
  display: inline-flex;
  align-items: center;
  padding: 6px 15px;
  font-size: 14px;
  color: #444;
  border: 1px solid #ddd;
  border-radius: 999px;
  background-color: #fafafa;
  text-decoration: none;
  transition: all 0.3s ease;
}

.auth-buttons a i {
  margin-right: 6px;
}

.auth-buttons a:hover {
  background-color: #f1f1f1;
  border-color: #ccc;
  color: #000;
}

</style>

<header>
  <div class="header-top">
    <div class="social-icons">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-youtube-play"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
    </div>
    <div class="hotline">
      <strong>Hotline:</strong> 0342.075.321 <span style="font-size: 12px; color: #999">(8h - 22h)</span>
    </div>
  </div>

  <div class="header-middle">
    <div class="logo">
      <a href="/">
        <img src="{{ asset('frontend/images/logo.jpg') }}" alt="Logo">
      </a>
    </div>
    <nav class="navbar">
      <a href="{{ url('/') }}">Trang chủ</a>
      <a href="{{ url('/nick-pubg') }}">Nick PUBG</a>
      <a href="{{ url('/nick-lq') }}">Nick LQ</a>
      <a href="{{ url('/nap-tien') }}">Nạp tiền</a>
    </nav>
    <div class="auth-buttons">
      <a href="{{ url('/login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
      <a href="{{ url('/register') }}"><i class="fa fa-key"></i> Đăng ký</a>
    </div>
  </div>
</header>