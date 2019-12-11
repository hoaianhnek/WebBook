@extends('admin.v_admin_dashboard')
@section('ship_show')

<section id="main-content">
  <section class="wrapper">
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
    QUẢN LÝ PHÍ SHIP
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-3 m-b-xs"> </div>
        <form action="ship-add" method="POST">
            {{csrf_field()}}
            <div class="col-sm-4">
              <input type="text" class="input-sm form-control" placeholder="Tên thành phố" name="country">
            </div>
            <div class="col-sm-2">
              
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Phí ship" name="charges">
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
                  <th>Tên thành phố/ tỉnh</th>
                  <th>Phí ship</th>
                  <th style="width:30px;"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($arrShip as $ship)
                  	<tr>
	                    <td>{{$ship->id_ship}}</td>
	                    <td>
                      		<span class="text-ellipsis">{{$ship->country}}</span>
                    	</td>
                      <td>
                          <span class="text-ellipsis">{{$ship->charges}} đ</span>
                      </td>
	                    <td>
	                      	<a href="shipping-edit-show-{{$ship->id_ship}}" class="active" ui-toggle-class="">
	                        	<i class="fa fa-edit text-success text-active"></i>
                          </a>
                          <a href="shipping-delete-{{$ship->id_ship}}" class="active" ui-toggle-class="">
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