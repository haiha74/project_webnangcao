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