@extends('admin.v_admin_dashboard')
@section('shipping_edit')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Sửa phí ship
                </div>
                @foreach($arrShip as $ship)
                <form action="shipping-edit-{{$ship->id_ship}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên thành phố/ tỉnh</label>
                            <input type="text" class="form-control" name="country" value="{{$ship->country}}">
                        </div> 
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Phí ship</label>
                            <input type="text" class="form-control" name="charges" value="{{$ship->charges}}">
                        </div>
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

@stop