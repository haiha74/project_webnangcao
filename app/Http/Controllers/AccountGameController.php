<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Account;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class AccountGameController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if (!$admin_id) {
            return Redirect::to('admin')->send();
        }
    }

    public function add_account (){
        $this->Authlogin();
        $cate_game = DB::table('tbl_category_game')->orderby('category_id','desc')->get();

        return view('admin.add_account')->with('cate_game', $cate_game);
    }

    public function all_account (){
        $this->Authlogin();
        $all_account = DB::table('tbl_account')->orderby('account_id', 'desc')->get();
        $manager_account = view('admin.all_account')->with('all_account', $all_account);
        return view('admin_layout')->with('admin.all_account', $manager_account);
    }

    public function save_account(Request $request){
        $this->Authlogin();
        $data = array();
        $data['account_name'] = $request->account_name;
        $data['account_price'] = $request->account_price;
        $data['account_desc'] = $request->account_desc;
        $data['account_content'] = $request->account_content;
        $data['category_id'] = $request->account_cate;
        $data['account_status'] = $request->account_status;
        $data['account_image'] = $request->account_image;

        $get_image = $request->file('account_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/account', $new_image);
            $data['account_image'] = $new_image;
        }

        DB::table('tbl_account')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function edit_account($account_id){
        $this->Authlogin();
        $cate_game = DB::table('tbl_category_game')->orderby('category_id', 'desc')->get();
        $edit_account = DB::table('tbl_account')->where('account_id', $account_id)->first();

        $manager_account = view('admin.edit_account')
            ->with('edit_account', $edit_account)
            ->with('cate_game', $cate_game);

        return view('admin_layout')->with('admin.edit_account', $manager_account);
    }

    public function unactive_account($account_id){
        $this->Authlogin();
        DB::table('tbl_account')->where('account_id', $account_id)->update(['account_status' => 1]);
        Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function active_account($account_id){
        $this->Authlogin();
        DB::table('tbl_account')->where('account_id', $account_id)->update(['account_status' => 0]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function update_account(Request $request, $account_id){
        $this->Authlogin();
        $data = array();
        $data['account_name'] = $request->account_name;
        $data['account_price'] = $request->account_price;
        $data['account_desc'] = $request->account_desc;
        $data['account_content'] = $request->account_content;
        $data['category_id'] = $request->account_cate;
        $data['account_status'] = $request->account_status;

        $get_image = $request->file('account_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/account', $new_image);
            $data['account_image'] = $new_image;
        }

        DB::table('tbl_account')->where('account_id', $account_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function delete_account($account_id){
        $this->Authlogin();
        DB::table('tbl_account')->where('account_id', $account_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-account');
    }

    public function details_account($account_id){
        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $details_account = DB::table('tbl_account')
            ->join('tbl_category_game', 'tbl_category_game.category_id', '=', 'tbl_account.category_id')
            ->where('tbl_account.account_id', $account_id)
            ->get();

        return view('pages.sanpham.show_details')
            ->with('category', $cate_game)
            ->with('account_details', $details_account);
    }


    //SHOW ACCOUNT
    public function acc_pubg(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 5)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_pubg')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function acc_lienquan(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 6)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_lienquan')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function acc_freefire(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 7)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_freefire')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function acc_lienminh(){

        $cate_game = DB::table('tbl_category_game')
            ->where('category_status', 0)
            ->orderBy('category_id', 'desc')
            ->get();

        $accounts = DB::table('tbl_account')
            ->where('category_id', 8)
            ->where('account_status', 1)
            ->orderBy('account_id', 'desc')
            ->get();

        return view('pages.category.acc_lienminh')
            ->with('category', $cate_game)
            ->with('accounts', $accounts);
    }

    public function xuLyMuaHang(Request $request){
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Bạn cần đăng nhập để mua hàng');
        }

        $account = Account::find($request->account_id);
        if (!$account) {
            return back()->with('error', 'Tài khoản không tồn tại');
        }

        \App\Models\Order::create([
            'user_id'       => Auth::id(),
            'account_id'    => $account->account_id,
            'account_name'  => $account->account_name,
            'account_desc'  => $account->account_desc,
            'account_price' => $account->account_price,
        ]);

        $account->delete();
        return redirect('/lich-su-mua-hang')->with('success', 'Mua hàng thành công, vui lòng kiểm tra LỊCH SỬ MUA HÀNG để nhận sản phẩm');
    }

}
