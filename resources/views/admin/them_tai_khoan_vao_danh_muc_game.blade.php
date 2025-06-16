@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL::to('/luu-category-game')}} " method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">Tên danh mục</label>
                                    <input type="text" name="category_game_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh danh mục</label>
                                    <input type="file" name="category_image" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows = "8" class="form-control" name="category_game_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Hiển thị</label>
                                     <select name="category_game_status" class="form-control input-sm m-bot15">

                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                       
                                    </select>                                    
                                </div>                          
                                <button type="submit" name="them_tai_khoan_vao_danh_muc_game" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection