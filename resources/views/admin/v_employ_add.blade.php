@extends('admin.v_admin_dashboard')
@section('employ_add')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Thêm Nhân Viên
                </div>
                <form action="employ-add" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên Nhân viên</label>
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
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Chức vụ</label>
                            <select class="input-sm form-control w-sm inline v-middle" name="role">
                                <option value="1">Admin</option>
                                <option value="2">Staff</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Password</label>
                            <input type="text" class="form-control" name="password">
                            @if($errors->has('password'))
                            <p style="color:red">{{$errors->first('password')}}</p>
                            @endif
                        </div> 
                    </div>
                    <div class="modal-footer" >
                        <button type="submit" name="submit-save" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
</section>

@stop