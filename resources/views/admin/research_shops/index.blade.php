@extends('vendor.adminlte.layouts.app')
@section('contentheader_title')
  {{ trans('adminlte_lang::message.maps') }}
@endsection
@section('main-content')

  <script type="text/javascript">

    var markerData = [
      @foreach($shop_lists as $shop)
      {
        id: {{$shop->shop_category=="総合リサイクルショップ" ? 1 : 2}},
        name: '{{$shop->shop}}{{$shop->shop_branch}}',
        lat: {{$shop->lat}},
        lng: {{$shop->lng}}
      },
      @endforeach
    ];
    console.log(markerData);

    $(document).ready(function(){
      var map = new GMaps({
        div: '#map',
        zoom: 12,
        lat: 35.685664,
        lng: 139.708752
      });
      
      //配列の数だけ回す
      for (var i = 0; i < markerData.length; i++) {
        console.log(markerData[0]['lat']);
        console.log(markerData[i]['lat']);
        //表示
        map.drawOverlay({
                  lat: markerData[i]['lat'],
                  lng: markerData[i]['lng'],
          layer: 'overlayLayer',
          content: '<div class="overlay' + markerData[i]['id'] + '">' + markerData[i]['name'] + '<div class="overlay_arrow' + markerData[i]['id'] + ' above"></div></div>',
          verticalAlign: 'top',
          horizontalAlign: 'center'
              });
      }
    });
  </script>

  <div id="map" class="large"></div>

  <div class="col-sm-12 box">
    <!-- 地図を表示      -->
        
    @if($shop_lists)

        <table id="foo-table" class="table" >
            <thead>
        <th>{{ trans('adminlte_lang::message.shop_lists') }}</th>
        <th>{{ trans('adminlte_lang::message.category') }}</th>
                <th>{{ trans('adminlte_lang::message.shops') }}</th>
        <th>{{ trans('adminlte_lang::message.postal_code') }}</th>
        <th>{{ trans('adminlte_lang::message.address') }}</th>
        <th>{{ trans('adminlte_lang::message.tel') }}</th>
            </thead>
            <tbody>
       
      @foreach($shop_lists as $list) 
          <tr>
            <td>{{ $list->shop }}</td>
            <td>{{ $list->category }}</td>
            <td><a href="{{ $list->url }}" target="_blank">{{ $list->shop_branch }}</a></td>

            <td>{{ $list->postal_code }}</td>
            <td>{{ $list->address1 }}</td>
            <td>{{ $list->tel }}</td>
                 </tr>
      @endforeach

         </tbody> </table>

        @endif
    </div>

@stop
