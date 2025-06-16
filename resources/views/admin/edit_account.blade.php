@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật tài khoản game
            </header>                       
            <div class="panel-body"> 

                <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">' .$message.'</span>';
                        Session::put('message', null);
                    }
                ?>

                <div class="position-center">
                @php 
                    $acc = $edit_account;
                @endphp 
                    <form role="form" action="{{URL::to('/update-account/'.$acc->account_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">Tên tài khoản</label>
                            <input type="text" name="account_name" class="form-control" value="{{$acc->account_name}}">
                        </div>

                        <div class="form-group">
                            <label for="">Giá tài khoản</label>
                            <input type="text" name="account_price" class="form-control" value="{{$acc->account_price}}">
                        </div>

                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input type="file" name="account_image" class="form-control">
                            <img src="{{ URL::to('uploads/account/'.$acc->account_image) }}" height="100" width="100">
                        </div>

                        <div class="form-group">
                            <label for="">Mô tả tài khoản</label>
                            <textarea style="resize: none" rows="6" class="form-control" name="account_desc">{{$acc->account_desc}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Nội dung tài khoản</label>
                            <textarea style="resize: none" rows="6" class="form-control" name="account_content">{{$acc->account_content}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select name="account_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_game as $key => $cate)
                                    <option value="{{$cate->category_id}}" {{ $cate->category_id == $acc->category_id ? 'selected' : '' }}>
                                        {{$cate->category_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Hiển thị</label>
                            <select name="account_status" class="form-control input-sm m-bot15">
                                <option value="0" {{ $acc->account_status == 0 ? 'selected' : '' }}>Ẩn</option>
                                <option value="1" {{ $acc->account_status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info">Cập nhật tài khoản</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
