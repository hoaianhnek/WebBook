@extends('admin.v_admin_dashboard')
@section('discount_edit')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Sửa Khuyến Mãi
                </div>
                
                <form action="" method="">
                    <!-- {{ csrf_field() }} -->
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên khách hàng</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Email</label>
                            <input type="text" class="form-control" name="email" value="">
                        </div>   
                    </div>  
                    
                    <div class="form-row">
                     
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold">Địa chỉ</label>
                            <select class="input-sm form-control w-sm inline v-middle" name="country">
                                <option value=""></option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">SĐT</label>
                            <input type="text" class="form-control" name="phone" value="">
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