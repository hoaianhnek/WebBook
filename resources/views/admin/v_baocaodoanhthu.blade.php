@extends('admin.v_admin_dashboard')
@section('body_report')

    
<section id="main-content">
	<section class="wrapper">
        <div class="col-sm-5 m-b-xs" style="margin-top: 40px">
        <form action="report-year" method="POST">
            {{csrf_field()}}
        <select class="input-sm form-control w-sm inline v-middle" name="year" id="year">
            @if(isset($yearnow))
                <option value="{{$yearnow}}">{{$yearnow}}</option>
                @foreach($notyearnow as $year)
                <option value="{{$year->year}}">{{$year->year}}</option>
                @endforeach
            @else
                <option>--Chọn năm--</option>
                @foreach($year as $y)
                <option value="{{$y->year}}">{{$y->year}}</option>
                @endforeach
            @endif
            </select>
            <button class="btn btn-sm btn-default" name="submit-filter" type="submit">Apply</button> 
            <button class="btn btn-sm btn-default" type="submit">Show All</button>   
            </form>              
          </div>
		<div class="table-agile-info" style="margin-top:20px ">

    		<div id="columnchart_material" style="width:auto;height: 500px; margin-bottom: 50px;margin-right: 20px;margin-top: 30px"></div>
    	</div>
	
</section>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tháng', 'Doanh Thu'],

          ['1',{{$total[0]}} ],
          ['2',{{$total[1]}} ],
          ['3',{{$total[2]}} ],
          ['4',{{$total[3]}} ],
          ['5',{{$total[4]}} ],
          ['6',{{$total[5]}} ],
          ['7',{{$total[6]}} ],
          ['8',{{$total[7]}} ],
          ['9',{{$total[8]}} ],
          ['10',{{$total[9]}} ],
          ['11',{{$total[10]}} ],
          ['12',{{$total[11]}} ]
        ]);

        var options = {
          chart: {
            title: 'BÁO CÁO DOANH THU',
            subtitle: '--BOOK STORE--',
          },
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

          </script>
@stop