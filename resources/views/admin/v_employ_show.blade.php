@extends('admin.v_admin_dashboard')
@section('employ_show')

<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
      <div class="panel panel-default">
        <div class="panel-heading">
      QUẢN LÝ NHÂN VIÊN
        </div>
        <div class="row w3-res-tb">
          <div class="col-sm-5 m-b-xs">            
          </div>
          <div class="col-sm-4">
          </div>
          <div class="col-sm-3">
            <div class="input-group">
              
            </div>
          </div>
        </div>
          <div class="table-responsive">
              <table class="table table-striped b-t b-light">
                  <thead>
                    <tr>
                    <th data-breakpoints="xs">ID</th>
                    <th>Tên Nhân Viên</th>
                    <th>Email</th>
                    <th data-breakpoints="xs">Password</th>
                    <th>Chức vụ</th>
                    <th style="width:30px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($arrUser as $user)
                    	<tr>
  	                    <td>{{$user->id}}</td>
  	                    <td>
                    		<span class="text-ellipsis">{{$user->name}}</span>
                      	</td>
                      	<td>
                    		<span class="text-ellipsis">{{$user->email}}</span>
                      	</td>
                      	<td>
                    		<span class="text-ellipsis">{{$user->password}}</span>
                      	</td>
                      	<td>
                        	@if($user->role == 1)
                        	Admin
                        	@else
                        	Staff
                        	@endif
                      	</td>
  	                    <td>
  	                      	<a href="employ-edit-view-{{$user->id}}" class="active" ui-toggle-class="">
  	                        	<i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a href="employ-delete-{{$user->id}}" class="active" ui-toggle-class="">
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