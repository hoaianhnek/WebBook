@extends('admin.v_admin_dashboard')
@section('customer_edit')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Sửa Khách Hàng
                </div>
                @foreach($Cus as $cus)
                <form action="customer-edit-{{$cus->id_Cus}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên khách hàng</label>
                            <input type="text" class="form-control" name="name" value="{{$cus->name}}">
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Email</label>
                            <input type="text" class="form-control" name="email" value="{{$cus->email}}">
                        </div>   
                    </div>  
                    
                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tỉnh/ thành phố</label><br>
                            <select class="input-sm form-control w-sm inline v-middle thanhphokhachhang" name="country">
                                @if(isset($cus->id_Ship))
                                    <option value="{{$cus->id_Ship}}">{{$cus->country}}</option>
                                    @foreach($arrShip as $ship)
                                    <option value="{{$ship->id_Ship}}">{{$ship->country}}</option>
                                    @endforeach
                                @else
                                    <option>--Chọn thành phố/ tỉnh--</option>
                                    @foreach($arrship as $ship)
                                    <option value="{{$ship->id_Ship}}">{{$ship->country}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">SĐT</label>
                            <input type="text" class="form-control" name="phone" value="{{$cus->phone_Cus}}">
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Địa chỉ</label>
                            <input type="text" class="form-control" name="addr" value="{{$cus->add_Cus}}">
                        </div>  
                     </div>
                    <div class="modal-footer" >
                        <!-- <button type="submit" name="submit-cancel" class="btn btn-danger">Cancel</button> -->
                        <button type="submit" name="submit-save" class="btn btn-success">Save</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
</section>

@stop