@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb','ダッシュボード')
@section('contentheader_title')
    ダッシュボード
@endsection

@section('main-content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>

    <div class="">

<script>
window.onload = function() {
    ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: complexChartOption
    });
};
</script>

<script>
      
  var barChartData = {
    labels: [
      <?php $length = count($monthly_purchase); ?>
      <?php $no = 0 ?>
      @foreach($monthly_purchase as $purchase)
          '{{$purchase->month}}'
          <?php $no++ ?>
          {{$no != $length ? ',' : '' }}
      @endforeach
    ],
    datasets: [
    {
        type: 'line',
        label: '仕入れ金額',
        data: [
          <?php $length = count($monthly_purchase); ?>
          <?php $no = 0 ?>
          @foreach($monthly_purchase as $purchase)
              '{{str_replace(',','',$purchase->price)}}'
              <?php $no++ ?>
              {{$no != $length ? ',' : '' }}
          @endforeach
        ],
        borderColor : "rgba(254,97,132,0.8)",
        pointBackgroundColor    : "rgba(254,97,132,0.8)",
        fill: false,
        yAxisID: "y-axis-1",// 追加
    },
    {
        type: 'bar',
        label: '仕入れ個数',
        data: [
        
          <?php $length = count($monthly_purchase); ?>
          <?php $no = 0 ?>
          @foreach($monthly_purchase as $purchase)
            '{{ ($purchase->num)}}'
            <?php $no++ ?>
            {{$no != $length ? ',' : '' }}
          @endforeach
        
        ],
        borderColor : "rgba(54,164,235,0.8)",
        backgroundColor : "rgba(54,164,235,0.5)",
        yAxisID: "y-axis-2",
    },
    ],
  };
</script>
<script>
var complexChartOption = {
    responsive: true,
    scales: {
        yAxes: [{
            id: "y-axis-1",
            type: "linear", 
            position: "left",
            ticks: {
                max: 50000,
                min: 0,
                stepSize: 10000
            },
        }, {
            id: "y-axis-2",
            type: "linear", 
            position: "right",
            ticks: {
                max: 100,
                min: 0,
                stepSize: 10
            },
            gridLines: {
                drawOnChartArea: false, 
            },
        }],
    }
};
</script>


    <div class="">
        <h3>今月({{$this_year}}{{$this_month}})の状況</h3>
        <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon"><i class="fa fa-shopping-basket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">仕入金額</span>
                    <span class="info-box-number">{{$inv_month_money}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">仕入利益見込み</span>
                    <span class="info-box-number">{{$inv_expect_profit}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>        
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3><a href="{{ url('admin/mws/fba-inv')}}">在庫管理</a></h3>
            <div class="col-sm-6">
                <table class="table table-striped stock">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="green">30日以内</th>
                        <th class="yellow">60日以内</th>
                        <th class="yellow">90日以内</th>
                        <th class="red">90日以上</th>
                        <th>合計</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fba_data as $data)
                        <tr>
                            <td>個数</td>
                            <td class="green"> {{ $data->under30 }} </td>
                            <td class="yellow"> {{ $data->under60 }} </td>
                            <td class="yellow"> {{ $data->under90 }} </td>
                            <td class="red"> {{ $data->over90 }} </td>
                            <td> {{ $data->total_count }} </td>
                        </tr>
                        <tr>
                            <td>金額</td>
                            <td class="green"> {{ $data->under30sum }} </td>
                            <td class="yellow"> {{ $data->under60sum }} </td>
                            <td class="yellow"> {{ $data->under90sum }} </td>
                            <td class="red"> {{ $data->over90sum }} </td>
                            <td> {{ $data->total_sum }} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
        <h3>販売管理</h3>
        <div class="col-sm-6">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>月</th>
                <th>仕入数</th>
                <th>仕入額</th>
            </tr>
            </thead>
            <tbody>
            @foreach($monthly_purchase as $each_purchase)

                @if( $each_purchase->month  == '2015/12')
                    @break
                @else
                    <tr>
                        <td> {{ $each_purchase->month }} </td>
                        <td> {{ $each_purchase->num }} </td>
                        <td> {{ $each_purchase->price }} </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        </div>
            <div class="col-sm-6">
                <canvas id="canvas"></canvas>
            </div>
    </div>

 <div class="col-sm-12">
 <h3><a href="{{ url('admin/rss-read')}}">RSSニュース</a></h3>       
<table class="table table-striped">
            <thead>
            <tr>
                <th>date</th>
                <th>title</th>
                <th>site</th>
            </tr>
            </thead>
            <tbody>
              @foreach($rss_news as $news)
                    <tr>
                        <td> {{ $news->created_at }} </td>
                        <td> <a href="{{ $news->url }}" target="_blank">{{ $news->title }}</a></td>
                        <td> {{ $news->site }} </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
</div>


@stop
