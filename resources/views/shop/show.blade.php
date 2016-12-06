@extends('layouts.shopDefault')

@section('title', $item->name)
@section('header-right')
@endsection

@section('content')

  <div class="items-wrapper">
    <div class="item-detail-wrapper">
      <div class="item_left">
        @foreach($item->inv_photo as $photo)
          @if($photo->number == 1)
            <img src="{{ $photo->file }}" alt="{{ $item->name }} " class="item-pic-first">
          @else
            <img src="{{ $photo->file }}" alt="{{ $item->name }} " class="item-pic-other">
          @endif
        @endforeach
      </div>
      <!-- left end  -->
      <div class="item_right">
        <table class="item-table">
          <tr>
            <th>出品者</th>
            <td>{{ $item->merchant->name }}</td>
          </tr>
          <tr>
            <th>コンディション</th>
            <td>{{ $item->condition->name }}</td>
          </tr>
          <tr>
            <th>値段</th>
            <td>{{ number_format($item->sell_price) }}円</td>
          </tr>
        </table>
      </div>
      <!-- rigtht end  -->
      <div class="clear-fix"></div>
      <div class="item-price">   
          <h4>{{ number_format($item->sell_price) }}円</h4>
      </div>
      <div class="purchase">
        <form method="get" action="{{ url('/shop/cart/2') }}" class="purchase">
 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
          <input type="hidden" value="{{ $item->id }}" name="id" class="btn">     
          <input type="submit" value="確認して購入する" id="purchase" class="btn">
        </form>
      </div>

    </div>
    <!-- item detail end -->
  </div>
  <!-- end item&#45;wrapper -->
@endsection
