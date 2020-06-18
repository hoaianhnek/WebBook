@extends('admin.v_admin_dashboard')
@section('employ_edit')
@if(isset($error))
    <section class="alert alert-warning text-center">{{$error}}</section>
@endif
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Sửa Nhân Viên
                </div>
                <form action="update-employ-{{$employ->id}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên nhân viên</label>
                            <input type="text" class="form-control" name="name" value="{{$employ->name}}">
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Email</label>
                            <input type="text" class="form-control" name="email" value="{{$employ->email}}">
                        </div>   
                    </div>  
                    
                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Chức vụ</label>
                            <select class="input-sm form-control w-sm inline v-middle" name="role">
                               	@if($employ->role==1)
                                <option value="{{$employ->role}}">Admin</option>
                                <option value="2">Staff</option>
                                @else
                                <option value="{{$employ->role}}">Staff</option>
                                <option value="1">Admin</option>
                                @endif                                  
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Password</label>
                            <input type="text" class="form-control" name="password" value="{{$employ->password}}">
                        </div> 
                     </div>
                    <div class="modal-footer" >
                        <button type="submit" name="submit-cancel" class="btn btn-danger">Cancel</button>
                        <button type="submit" name="submit-save" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
</section>
@stop