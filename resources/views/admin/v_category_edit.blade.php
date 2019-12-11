@extends('admin.v_admin_dashboard')
@section('category_edit')

<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                Sửa thể loại
                </div>
                @foreach($arrType as $type)
                <form action="category-update-{{$type->id_Category}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">ID thể loại</label>
                            <input type="text" class="form-control" name="id_Category" value="{{$type->id_Category}}">
                        </div> 
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Tên thể loại</label>
                            <input type="text" class="form-control" name="name_Category" value="{{$type->name_Category}}">
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