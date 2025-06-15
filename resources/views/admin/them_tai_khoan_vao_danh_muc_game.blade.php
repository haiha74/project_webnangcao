@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-game')}}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">Tên sản phẩm </label>
                                    <input type="text" name="game_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="">Giá sản phẩm </label>
                                    <input type="text" name="game_price" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh sản phẩm </label>
                                    <input type="file" name="game_image" class="form-control" id="exampleInputEmail1" placeholder="Hình ảnh sản phẩm ">
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows = "8" class="form-control" name="game_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows = "8" class="form-control" name="game_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Danh mục sản phẩm</label>
                                     <select name="game_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_game as $key => $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        

                                        @endforeach
                                       
                                    </select>                                    
                                </div> 
                                <div class="form-group">
                                    <label for="">Hiển thị</label>
                                     <select name="game_status" class="form-control input-sm m-bot15">

                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                       
                                    </select>                                    
                                </div>                            
                                <button type="submit" name="add_game" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection