@extends('admin.v_admin_dashboard')
@section('discount_show')

<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
      <div class="panel panel-default">
        <div class="panel-heading">
      QUẢN LÝ KHUYẾN MÃI
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
                    <th>Tên khuyến mãi</th>
                    <th>Ngày bắt đầu</th>
                    <th data-breakpoints="xs">Ngày kết thúc</th>
                    <th>Mức khuyến mãi</th>
                    <th style="width:30px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($arrDis as $dis)
                        <tr>
                            <td>{{$dis->id_Discount}}</td>
                            <td>
                                <span class="text-ellipsis">{{$dis->name_Discount}}</span>
                            </td>
                            <td>
                                <span class="text-ellipsis">{{$dis->date_start}}</span>
                            </td>
                            <td>
                                <span class="text-ellipsis">{{$dis->date_end}}</span>
                            </td>
                            <td>
                                <span class="text-ellipsis">{{$dis->number_Discount}}</span>
                            </td>
                            <td>
                                <a href="discount-edit-view-{{$dis->id_Discount}}" class="active" ui-toggle-class="">
                                    <i class="fa fa-edit text-success text-active"></i>
                                </a>
                                <a href="discount-delete-{{$dis->id_Discount}}" class="active" ui-toggle-class="">
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