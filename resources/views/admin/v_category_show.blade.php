@extends('admin.v_admin_dashboard')
@section('category_show')

<section id="main-content">
  <section class="wrapper">
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
    QUẢN LÝ THỂ LOẠI
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs"> </div>
        <form action="add-category" method="POST">
            {{csrf_field()}}
            <div class="col-sm-2">
              <input type="text" class="input-sm form-control" placeholder="ID thể loại" name="id_Category">
            </div>
            <div class="col-sm-4">
              
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Tên thể loại" name="name_Category">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="submit">Thêm</button>
                    </span>
                </div>
            </div>
        </form>
      </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                  <tr>
                  <th data-breakpoints="xs">ID</th>
                  <th>Tên thể loại</th>
                  <th style="width:30px;"></th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($arrType as $type)
                  	<tr>
	                    <td>{{$type->id_Category}}</td>
	                    <td>
                      		<span class="text-ellipsis">{{$type->name_Category}}</span>
                    	</td>
	                    <td>
	                      	<a href="category-update-view-{{$type->id_Category}}" class="active" ui-toggle-class="">
	                        	<i class="fa fa-edit text-success text-active"></i>
                          </a>
                          <a href="category-delete-{{$type->id_Category}}" class="active" ui-toggle-class="">
	                        	<i class="fa fa-times text-danger text"></i>
	                      	</a>
	                    </td>
                  	</tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <footer class="panel-footer">
        </footer>
      </div>
    </div>
  </section>

@stop