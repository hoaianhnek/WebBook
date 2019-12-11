@extends('admin.v_admin_dashboard')
@section('discount_add')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Thêm Khuyến Mãi
                </div>
                <form action="discount-add" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên khuyến mãi</label>
                            <input type="text" class="form-control" name="name_Discount">
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Ngày bắt đầu</label>
                            <input type="date" class="form-control" name="date_start">
                        </div>   
                    </div>  
                    
                    <div class="form-row">
                     
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Ngày kết thúc</label>
                            <input type="date" class="form-control" name="date_end">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Mức khuyến mãi</label>
                            <input type="text" class="form-control" name="number_Discount">
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