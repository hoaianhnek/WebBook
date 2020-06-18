@extends('admin.v_admin_dashboard')
@section('book_edit')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Sửa sách
                </div>
                @foreach($book as $B)
                <form action="update-book-{{$B->id_Book}}" method="POST">
                    {{ csrf_field() }}
                    
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên sách</label>
                            <input type="text" class="form-control" name="name_Book" value="{{$B->name_Book}}">
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tác giả</label>
                            <input type="text" class="form-control" name="author" value="{{$B->author_Book}}">
                        </div>   
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group col-md-7">
                                <label class="font-weight-bold">Hình ảnh</label>
                                <input type="file" class="form-control hinhanhsach" name="image" id="image">
                            </div>
                            <div class="form-group col-md-5">
                                
                                <img src="../image/{{$B->image_Book}}" id = "show-image" width="auto"
                                height="130px">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Thể loại</label><br>
                                    <select class="input-sm form-control w-sm inline v-middle sach" name="category">
                                        <option value="{{$B->id_Category}}">{{$B->name_Category}}</option>
                                    @foreach($arrType as $Type)
                                        <option value="{{$Type->id_Category}}">{{$Type->name_Category}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Khuyến mãi</label><br>
                                    <select class="input-sm form-control w-sm inline v-middle sach" name="discount">
                                    @if(isset($B->id_Discount))
                                            <option value="{{$B->id_Discount}}">{{$B->name_Discount}}</option>
                                        @foreach($arrDis as $Dis)
                                            <option value="{{$Dis->id_Discount}}">{{$Dis->name_Discount}}</option>
                                        @endforeach
                                    @else
                                        <option value="">--Chọn khuyến mãi--</option>
                                        @foreach($arrDis as $Dis)
                                            <option value="{{$Dis->id_Discount}}">{{$Dis->name_Discount}}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                               <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Giá</label>
                                    <input type="text" class="form-control giasach" name="price" value="{{$B->price_Book}}">
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Số lượng</label>
                            <input type="text" class="form-control" name="amount" value="{{$B->amount_Book}}" disabled="true">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Nhà sản xuất</label>
                            <input type="text" class="form-control" name="nsx" value="{{$B->publishing_Book}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label font-weight-bold des">Describe:</label>
                        <textarea class="form-control des" rows="12" name="describe" style="width:96%">{{$B->describe_Book}}</textarea>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="submit" name="submit-cancel" class="btn btn-danger">Cancel</button> -->
                        <button type="submit" name="submit-save" class="btn btn-success">Save</button>
                    </div>
                   
                </form>
                 @endforeach
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