@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê tài khoản game
    </div>

    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Chọn tất cả</option>
          <option value="1">Xóa các mục đã chọn</option>
          <option value="2">Chỉnh sửa các mục đã chọn</option>
        </select>
        <button class="btn btn-sm btn-default">Hoàn tất</button>                
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-4">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm</button>
          </span>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      @if(Session::get('message'))
        <span class="text-alert">{{ Session::get('message') }}</span>
        {{ Session::put('message', null) }}
      @endif

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên tài khoản</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_account as $key => $acc)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $acc->account_name }}</td>
            <td>{{ number_format($acc->account_price) }} VNĐ</td>
            <td><img src="{{ asset('uploads/account/' . $acc->account_image) }}" height="100" width="100"></td>
            <td>
              {{ DB::table('tbl_category_game')->where('category_id', $acc->category_id)->value('category_name') }}
            </td>
            <td>
              @if($acc->account_status == 0)
                <a href="{{ URL::to('/unactive-account/'.$acc->account_id) }}">
                  <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                </a>
              @else
                <a href="{{ URL::to('/active-account/'.$acc->account_id) }}">
                  <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                </a>
              @endif
            </td>
            <td>
              <a href="{{ URL::to('/edit-account/'.$acc->account_id) }}" class="active styling-edit">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{ URL::to('/delete-account/'.$acc->account_id) }}" class="active styling-delete">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 20-30 của 50 tài khoản</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection
