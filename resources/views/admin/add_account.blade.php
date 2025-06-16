@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm tài khoản game
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
                    <form role="form" action="{{URL::to('/save-account')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Tên tài khoản game</label>
                            <input type="text" name="account_name" class="form-control" placeholder="Tên tài khoản game">
                        </div>
                        <div class="form-group">
                            <label for="">Giá tài khoản</label>
                            <input type="text" name="account_price" class="form-control" placeholder="Giá tài khoản">
                        </div>
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input type="file" name="account_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả tài khoản</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="account_desc" placeholder="Mô tả tài khoản"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung tài khoản</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="account_content" placeholder="Nội dung tài khoản"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Danh mục tài khoản</label>
                            <select name="account_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_game as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>                                    
                        </div> 
                        <div class="form-group">
                            <label for="">Hiển thị</label>
                            <select name="account_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>                                    
                        </div>                            
                        <button type="submit" name="add_account" class="btn btn-info">Thêm tài khoản</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
