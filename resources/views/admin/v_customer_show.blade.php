@extends('admin.v_admin_dashboard')
@section('customer_show')

<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
      <div class="panel panel-default">
        <div class="panel-heading">
      QUẢN LÝ KHÁCH HÀNG
        </div>
        <div class="row w3-res-tb">
          <div class="col-sm-5 m-b-xs">            
          </div>
          <div class="col-sm-4">
          </div>
          <div class="col-sm-3">
            <div class="input-group">
              <input type="text" class="input-sm form-control" placeholder="Search">
              <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
          <div class="table-responsive">
              <table class="table table-striped b-t b-light">
                  <thead>
                    <tr>
                    <th data-breakpoints="xs">ID</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th data-breakpoints="xs">SĐT</th>
                    <th>Địa chỉ</th>
                    <th style="width:30px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($arrCus as $Cus)
                    	<tr>
  	                    <td>{{$Cus->id_Cus}}</td>
  	                    <td>
                    		<span class="text-ellipsis">{{$Cus->name}}</span>
                      	</td>
                      	<td>
                    		<span class="text-ellipsis">{{$Cus->email}}</span>
                      	</td>
                      	<td>
                    		<span class="text-ellipsis">{{$Cus->phone_Cus}}</span>
                      	</td>
                      	<td>
                          @if(isset($Cus->id_Ship))
                        		<span class="text-ellipsis">{{$Cus->country}}</span>
                            @endif
                      	</td>
  	                    <td>
  	                      	<a href="customer-edit-view-{{$Cus->id_Cus}}" class="active" ui-toggle-class="">
  	                        	<i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a href="customer-delete-{{$Cus->id_Cus}}" class="active" ui-toggle-class="">
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