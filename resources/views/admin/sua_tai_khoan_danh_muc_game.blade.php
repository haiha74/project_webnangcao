@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục tài khoản game
                        </header>
                        
                        <?php
                                $message = Session::get('message');
                                if($message){
                                echo '<span class="text-alert">' .$message.'</span>';
                                Session::put('message', null);
                                }
                        ?>

                        <div class="panel-body">                 
                            <div class="position-center">
                                <form role="form" action="{{ URL::to('/capnhat-category-game/' . $sua_tai_khoan_danh_muc_game->category_id) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="">Tên danh mục tài khoản game</label>
                                        <input type="text" value="{{ $sua_tai_khoan_danh_muc_game->category_name }}" name="category_game_name" class="form-control" placeholder="Tên danh mục tài khoản game">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh danh mục</label>
                                        <input type="file" name="category_image" class="form-control">
                                        @if($sua_tai_khoan_danh_muc_game->category_image)
                                            <img src="{{ asset('uploads/category/' . $sua_tai_khoan_danh_muc_game->category_image) }}" height="100" width="100">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mô tả danh mục tài khoản game</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="category_game_desc" placeholder="Mô tả danh mục tài khoản game">{{ $sua_tai_khoan_danh_muc_game->category_desc }}</textarea>
                                    </div>
                                    <button type="submit" name="capnhat_category_game" class="btn btn-info">Cập nhật danh mục tài khoản game</button>
                                </form>

                            </div>
                        </div>

                    </section>

            </div>
@endsection