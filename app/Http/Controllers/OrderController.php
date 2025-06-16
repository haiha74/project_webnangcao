<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function xuLyMuaHang(Request $request)
    {
        $account = Account::find($request->account_id);
        if (!$account) {
            return back()->with('error', 'Không tìm thấy tài khoản');
        }

        Order::create([
            'user_id' => Auth::id(),
            'account_id' => $account->account_id,
            'account_name' => $account->account_name,
            'account_desc' => $account->account_desc,
            'account_content' => $account->account_content,
            'account_price' => $account->account_price,
        ]);

        $account->delete();

        return redirect()->route('lich-su-mua-hang')->with('success', 'Mua hàng thành công, vui lòng kiểm tra lịch sử mua hàng.');
    }

    public function lichSu()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('pages.history.orders', compact('orders'));
    }
}
