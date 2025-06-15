<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class CategoryGame extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if (!$admin_id) {
            return Redirect::to('admin')->send();
        }
    }

    public function them_tai_khoan_vao_danh_muc_game (){
        $this->Authlogin();
        return view('admin.them_tai_khoan_vao_danh_muc_game');
    }

    public function tat_ca_tai_khoan_danh_muc_game (){
        $this->Authlogin();
        $all_category_game = DB::table('tbl_category_game')->get();
        $manager_category_game = view('admin.tat_ca_tai_khoan_danh_muc_game')->with('tat_ca_tai_khoan_danh_muc_game' ,$tat_ca_tai_khoan_danh_muc_game);
        return view('admin_layout')->with('admin.tat_ca_tai_khoan_danh_muc_game' ,$manager_category_game);
    }

    public function luu_category_game (Request $request){
        $this->Authlogin();
        $data = array();
        $data['category_name'] = $request->category_game_name;
        $data['category_desc'] = $request->category_game_desc;
        $data['category_status'] = $request->category_game_status;

        DB::table('tbl_category_game')->insert($data);
        Session::put('message', 'Thêm tài khoản danh mục game thành công');
        return Redirect::to('them-tai-khoan-vao-danh-muc-game');
    }

    public function edit_category_game ($category_game_id){
        $this->Authlogin();
        $edit_category_game = DB::table('tbl_category_game')->where('category_id' ,$category_game_id)->get();
        $manager_category_game = view('admin.sua_tai_khoan_danh_muc_game')->with('sua_tai_khoan_danh_muc_game' ,$sua_tai_khoan_danh_muc_game);
        return view('admin_layout')->with('admin.sua_tai_khoan_danh_muc_game' ,$manager_category_game);
    }

    public function cap_nhat_category_game (Request $request,$category_game_id){
        $this->Authlogin();
        $data = array();
        $data['category_name'] = $request->category_game_name;
        $data['category_desc'] = $request->category_game_desc;

        DB::table('tbl_category_game')->where('category_id' ,$category_game_id)->update($data);
        Session::put('message', 'Cập nhật tài khoản danh mục game thành công');
        return Redirect::to('tat_ca_tai_khoan_danh_muc_game');
    }

    public function delete_category_game ($category_game_id){
        $this->Authlogin();
        DB::table('tbl_category_game')->where('category_id' ,$category_game_id)->delete();
        Session::put('message', 'Xóa tài khoản danh mục game thành công');
        return Redirect::to('tat_ca_tai_khoan_danh_muc_game');
        
    }

    // end fuction admin page
    public function show_category_home($category_id){
    $cate_game = DB::table('tbl_category_game')
        ->where('category_status','0')
        ->orderBy('category_id','desc')
        ->get();

    $brand_game = DB::table('tbl_brand')
        ->where('brand_status','0')
        ->orderBy('brand_id','desc')
        ->get();

    $category_by_id = DB::table('tbl_game')
        ->join('tbl_category_game','tbl_game.category_id','=','tbl_category_game.category_id')
        ->where('tbl_game.category_id', $category_id)
        ->get();

    $category_name = DB::table('tbl_category_game')
        ->where('category_id', $category_id)
        ->limit(1)
        ->get();

    return view('pages.category.show_category')
        ->with('category', $cate_game)
        ->with('brand', $brand_game)
        ->with('category_by_id', $category_by_id)
        ->with('category_name', $category_name);
}

    


}
