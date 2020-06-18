@extends('admin.v_admin_dashboard')
@section('book_add')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Thêm Sách
                </div>
                <form action="add-book" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên sách</label>
                            <input type="text" class="form-control" name="name_Book">
                            <span class="focus-input" data-placeholder="&#xe82a;"></span>
                            @if($errors->has('name_Book'))
                                <p style="color:red">{{$errors->first('name_Book')}}</p>
                            @endif
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tác giả</label>
                            <input type="text" class="form-control" name="author">
                            @if($errors->has('author'))
                                <p style="color:red">{{$errors->first('author')}}</p>
                            @endif
                        </div>   
                    </div>  
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group col-md-7">
                                <label class="font-weight-bold">Hình ảnh</label>
                                <input type="file" class="form-control hinhanhsach" name="image" id="image">
                                @if($errors->has('image'))
                                <p style="color:red">{{$errors->first('image')}}</p>
                                @endif
                            </div>
                            <div class="form-group col-md-5">
                                <img src="" id = "show-image" width="auto"
                                height="130px">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Thể loại</label><br>
                                    <select class="input-sm form-control w-sm inline v-middle sach" name="category">
                                        <option value="">--Chọn thể loại--</option>
                                    @foreach($arrType as $Type)
                                        <option value="{{$Type->id_Category}}">{{$Type->name_Category}}</option>
                                    @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <p style="color:red">{{$errors->first('category')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Khuyến mãi</label><br>
                                    <select class="input-sm form-control w-sm inline v-middle sach" name="discount">
                                        <option value="">--Chọn khuyến mãi--</option>
                                    @foreach($arrDis as $Dis)
                                        <option value="{{$Dis->id_Discount}}">{{$Dis->name_Discount}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                               <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Giá</label>
                                    <input type="text" class="form-control giasach" name="price">
                                    @if($errors->has('price'))
                                        <p style="color:red">{{$errors->first('price')}}</p>
                                    @endif
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Số lượng</label>
                            <input type="text" class="form-control" name="amount">
                            @if($errors->has('amount'))
                                <p style="color:red">{{$errors->first('amount')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Nhà sản xuất</label>
                            <input type="text" class="form-control" name="nsx">
                            @if($errors->has('nsx'))
                                <p style="color:red">{{$errors->first('nsx')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label font-weight-bold des">Describe:</label>
                        <textarea class="form-control des" rows="12" name="describe" style="width:96%"></textarea>
                        @if($errors->has('describe'))
                            <p style="color:red">{{$errors->first('describe')}}</p>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="submit" name="submit-cancel" class="btn btn-danger">Cancel</button> -->
                        <button type="submit" name="submit-save" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>
<script type="text/javascript">
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#show-image').attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#image').change(function(){
        readURL(this);
    });
</script>

@stop