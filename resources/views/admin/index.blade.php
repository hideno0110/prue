@extends('vendor.adminlte.layouts.app')
@section('content_breadcrumb','ダッシュボード')
@section('contentheader_title')
    ダッシュボード
@endsection
@section('main-content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
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
                    max: 1300000,
                    min: 0,
                    stepSize: 100000
                },
            }, {
                id: "y-axis-2",
                type: "linear", 
                position: "right",
                ticks: {
                    max: 350,
                    min: 0,
                    stepSize: 51
                },
                gridLines: {
                    drawOnChartArea: false, 
                },
            }],
        }
    };
</script>

<div class="">
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
    <!-- end monthly status -->
    <div class="row">
        <div class="col-sm-12">
            <h3><a href="{{ url('admin/mws/fba-inv')}}">在庫管理</a></h3>
            <div class="col-sm-8">
                <table class="table table-striped stock">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="green">30日以内</th>
                        <th class="yellow">60日以内</th>
                        <th class="yellow">90日以内</th>
                        <th class="red">120日以内</th>
                        <th class="red">150日以内</th>
                        <th class="red">180日以内</th>
                        <th class="red">180日以上</th>
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
                            <td class="red"> {{ $data->under120 }} </td>
                            <td class="red"> {{ $data->under150 }} </td>
                            <td class="red"> {{ $data->under180 }} </td>
                            <td class="red"> {{ $data->over180 }} </td>
                            <td> {{ $data->total_count }} </td>
                        </tr>
                        <tr>
                            <td>金額</td>
                            <td class="green"> {{ $data->under30sum }} </td>
                            <td class="yellow"> {{ $data->under60sum }} </td>
                            <td class="yellow"> {{ $data->under90sum }} </td>
                            <td class="red"> {{ $data->under120sum }} </td>
                            <td class="red"> {{ $data->under150sum }} </td>
                            <td class="red"> {{ $data->under180sum }} </td>
                            <td class="red"> {{ $data->over180sum }} </td>
                            <td> {{ $data->total_sum }} </td>
                        </tr>
                        <tr>
                            <td>率</td>
                            <td> {{round( intval(str_replace(",","",$data->under30sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }} </td>
                            <td> {{round( intval(str_replace(",","",$data->under60sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }} </td>
                            <td> {{round( intval(str_replace(",","",$data->under90sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }} </td>
                            <td> {{round( intval(str_replace(",","",$data->under120sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }} ({{ round( intval(str_replace(",","",$data->over90sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }}  ) </td>
                            <td> {{round( intval(str_replace(",","",$data->under150sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }} </td>
                            <td> {{round( intval(str_replace(",","",$data->under180sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }}  </td>
                            <td> {{round( intval(str_replace(",","",$data->over180sum)) / intval(str_replace(",","",$data->total_sum)) * 100)."%" }} </td>
                        </tr>
                      
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
    <!-- end stock status -->
    <div class="row">
        <div class="col-sm-12">
        <h3>販売管理</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>月</th>
                <th>売上</th>
                <th>返金</th>
                <th>手数料</th>
                <th>入金</th>
                <th>当月仕入額</th>
                <th>先月月末在庫</th>
                <th>当月月末在庫</th>
                <th>粗利益</th>
                <th>経費</th>
                <th>営業利益</th>
            </tr>
            </thead>
            <tbody>
            @foreach($summary_data as $each_data)

                @if( $each_data->month  == '2015/12')
                    @break
                @else
                    <tr>
                        <td> {{ $each_data->month }} </td>
                        <td> {{  number_format((int)$each_data->sales) }} </td>
                        <td> {{  number_format((int)$each_data->refund) }} </td>
                        <td> {{  number_format((int)$each_data->merchant_fee) }} </td>
                        <td> {{  number_format((int)$each_data->profit) }} </td>
                        <td> {{  number_format((int)$each_data->inv_price) }} </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>



                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <!-- end stock table -->
    </div>


    <div class="col-sm-12">
        <canvas id="canvas"></canvas>
    </div>
    <!-- end stock graph  -->


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
    <!-- end rss news -->
</div>
@stop
