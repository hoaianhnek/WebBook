@extends('admin.v_admin_dashboard')
@section('customer_add')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Thêm Khách Hàng
                </div>
                <form action="customer-add" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên khách hàng</label>
                            <input type="text" class="form-control" name="name">
                            @if($errors->has('name'))
                                <p style="color:red">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Email</label>
                            <input type="text" class="form-control" name="email">
                            @if($errors->has('email'))
                                <p style="color:red">{{$errors->first('email')}}</p>
                            @endif
                        </div>   
                        

                    </div>  
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold">Địa chỉ</label><br>
                            <select class="input-sm form-control w-sm inline v-middle thanhphokhachhang" name="country">
                                <option value="">--Chọn tỉnh/ thành phố--</option>
                                @foreach($arrShip as $ship)
                                <option value="{{$ship->id_ship}}">{{$ship->country}}</option>
                                @endforeach
                            </select>
                             @if($errors->has('country'))
                                <p style="color:red">{{$errors->first('country')}}</p>
                            @endif
                        </div>
                       
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">SĐT</label>
                            <input type="text" class="form-control" name="phone">
                            @if($errors->has('phone'))
                                <p style="color:red">{{$errors->first('phone')}}</p>
                            @endif
                        </div> 
                        
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Địa chỉ</label>
                            <input type="text" class="form-control" name="addr">
                            @if($errors->has('addr'))
                                <p style="color:red">{{$errors->first('addr')}}</p>
                            @endif 
                        </div> 
                        
                     </div>
                    <div class="modal-footer" >
                        <!-- <button type="submit" name="submit-cancel" class="btn btn-danger">Cancel</button> -->
                        <button type="submit" name="submit-save" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
</section>

@stop