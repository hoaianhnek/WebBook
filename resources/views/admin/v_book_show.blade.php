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
                    @endforeach
                </select>
                <button class="btn btn-sm btn-default" name="submit-filter" type="submit">Apply</button> 
                <button class="btn btn-sm btn-default" type="submit">Show All</button>   
                </form>              
            </div>
          <div class="col-sm-4">
          </div>
          <div class="col-sm-3">
            <li style="list-style-type: none;">
                <input type="text" class="form-control search" id="search" placeholder=" Search">
            </li>
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
                      @if(isset($arrBookDis))
                      @foreach($arrBookDis as $Book)
                      @if(isset($Book->id_Book))
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
                        <td>
                            {{$Book->name_Discount}}
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
                      @endif
                      @endforeach
                      @endif
                    
                        @if(isset($arrBook))
                  	   @foreach($arrBook as $Book)
                       @if(isset($Book->id_Book))
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
                        
  	                    <td>
                        </td>
  	                    <td>{{$Book->publishing_Book}}</td>
  	                    <td>
  	                      	<a href="update-{{$Book->id_Book}}" class="active" ui-toggle-class="">
  	                        	<i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a href="delete-{{$Book->id_Book}}" class="active" ui-toggle-class="">
  	                        	<i class="fa fa-times text-danger text"></i>
  	                      	</a>
                            d
  	                    </td>
                    	</tr>
                      @endif
                    	@endforeach
                      @endif
                    
                  </tbody>
              </table>
          </div>
          
          <footer class="panel-footer">
          </footer>
        </div>
      </div>
  </section>
  <script type="text/javascript">
      $("#search").on('keyup',function(){
        $search = $(this).val();
        $.ajax({
              type:"get",
              url:"{{URL::to('admin/load-Book-Ajax')}}",
              data: {'search':$search},
              dataType:"text",
              success:function(data){
                $('tbody').html(data);
              }
        });
      });
  </script>
@stop