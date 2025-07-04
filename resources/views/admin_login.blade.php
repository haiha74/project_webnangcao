<!DOCTYPE html>
<head>
<title>Trang quản lý Admin Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=""/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet"> 
<script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>

</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng Nhập</h2>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">' .$message.'</span>';
        Session::put('message', null);
    }
     ?>
		<form action="{{URL::to('/admin-dashboard')}}" method="post">
            {{csrf_field()}}
			<input type="text" class="ggg" name="admin_email" placeholder="Điền Email" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Điền mật khẩu" required="">
			<span><input type="checkbox" />Nhớ đăng nhập</span>
			<h6><a href="#">Quên mật khẩu?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng Nhập" name="login">
		</form>

</div>
</div>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
