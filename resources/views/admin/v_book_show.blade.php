@extends('admin.v_admin_dashboard')
@section('book_show')

<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
      <div class="panel panel-default">
        <div class="panel-heading">
      QUẢN LÝ SÁCH
        </div>
        <div class="row w3-res-tb">
          <div class="col-sm-5 m-b-xs">
            	<form action="{{URL::to('admin/book-view-filter')}}" method="POST">
                {{csrf_field()}}
            	<select class="input-sm form-control w-sm inline v-middle" name="type">
            	@foreach($arrType as $type)
              	<option value="{{$type->id_Category}}" name = "name_Category">{{$type->name_Category}}</option>
              	<!-- <input type="hidden" name="id_Type" value="{{$type->id_Category}}"> -->
              <!-- <option value="1">Delete selected</option>
              <option value="2">Bulk edit</option>
              <option value="3">Export</option> -->
              @endforeach
            </select>
            <button class="btn btn-sm btn-default" type="submit">Apply</button>  
            </form>              
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
                    <th>Tên sách</th>
                    <th>Hình ảnh</th>
                    <th data-breakpoints="xs">Mô tả</th>
                    <th>Tác giả</th>
                    <th>Thể loại</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Khuyến mãi</th>
                    <th>NSX</th>
                    <th style="width:30px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($arrBook as $Book)
                    	<tr>
  	                    <td>{{$Book->id_Book}}</td>
  	                    <td>
                        		<span class="text-ellipsis">{{$Book->name_Book}}</span>
                      	</td>
                      	<td>
                        		<img src="../../public/image/{{$Book->image_Book}}" style="width: 100px;height: 140px">
                      	</td>
                      	<td class="text-ellipsis">
                          <div style="overflow-y: scroll; height: 175px">
                        		{{$Book->describe_Book}}
                          </div>
                      	</td>
                      	<td>
                        		<span class="text-ellipsis">{{$Book->author_Book}}</span>
                      	</td>
                      	<td>
                        		<span class="text-ellipsis">{{$Book->name_Category}}</span>
                      	</td>
                      	<td>
                        		<span>{{$Book->price_Book}}</span>
                      	</td>
  	                    <td>
  	                      	<span>{{$Book->amount_Book}}</span>
  	                    </td>
                        
  	                    <td>@if(isset($Book->id_Discount))
                              {{$Book->name_Discount}}
                            @endif
                        </td>
  	                    <td>{{$Book->publishing_Book}}</td>
  	                    <td>
  	                      	<a href="update-{{$Book->id_Book}}" class="active" ui-toggle-class="">
  	                        	<i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a href="delete-{{$Book->id_Book}}" class="active" ui-toggle-class="">
  	                        	<i class="fa fa-times text-danger text"></i>
  	                      	</a>
  	                    </td>
                    	</tr>
                    	@endforeach
                  </tbody>
              </table>
          </div>
          
          <footer class="panel-footer">
          {{$arrBook->links()}}
          </footer>
        </div>
      </div>
  </section>

@stop