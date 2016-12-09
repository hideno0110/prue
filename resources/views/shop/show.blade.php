@extends('layouts.shopDefault')

@section('title', $item->name)
@section('header-right')
@endsection

@section('content')

  <div class="items-wrapper">
    <div class="item-detail-wrapper">
      <div class="item-name-wrapper"><h1>{{ $item->item_master->name  }}</h1></div>
      <div class="item_left">
          @if($item->number != 0)
            <img src="  
              @if($item->inv_photo->first()) 
                {{  $item->inv_photo->first()->file }}
              @elseif($item->item_master->file) 
                {{  $item->item_master->file }}
              @else
                {{ 'http://placehold.it/220x220' }}
              @endif
            ">
          @else
            <img src="{{  $item->inv_photo->first() ? $item->inv_photo->first()->file : 'http://placehold.it/220x220'  }}" class="sold">
          @endif

{{--      @if($item->inv_photo)
        @foreach($item->inv_photo as $photo)
          @if($photo->number == 1)
            <img src="{{ $photo->file }}" alt="{{ $item->name }} " class="item-pic-first">
          @else
            <img src="{{ $photo->file }}" alt="{{ $item->name }} " class="item-pic-other">
          @endif
        @endforeach
      @else
        @if($item->item_master->file) 
          {{  $item->item_master->file }}
        @else
          'http://placehold.it/220x220'
        @endif
      @endif
--}}
      </div>
      <!-- left end  -->
      <div class="item_right">
        <table class="item-table">
          <tr>
            <th colspan="2" class="title">商品情報</th>
          </tr>
          <tr>
            <th>出品者</th>
            <td>{{ $item->merchant->name }}</td>
          </tr>
          <tr>
            <th>コンディション</th>
            <td>{{ $item->condition->name }}</td>
          </tr>
          <tr>
            <th>ランキング(amazon)</th>
            <td>{{ $item->item_master->category }}</br>
                @if(intval($item->item_master->category) != 0) 
                  {{ number_format(intval($item->item_master->rank))."位" }}
                @else
                  {{ "- 位(ランク外)" }}
                @endif
            </td>
          </tr>
          <tr>
            <th>商品説明</th>
            <td>{{ $item->item_master->detail }}</td>
          </tr>
          <tr>
            <th>出品者より状態等の説明</th>
            <td>{{ $item->description}}</td>
          </tr>
          <tr>
            <th>送料</th>
            <td>キャンペーン中につき無料！</td>
          </tr>
        </table>
        <!-- end item info table -->

        <table class="item-table seller">
          <tr>
            <th colspan="2" class="title">出品者情報（会社・事業者名）</th>
          </tr>
          <tr>
            <th>出品者</th>
            <td>{{ $item->merchant->name }}<img src="{{$item->merchant->photo->file}}" class="merchant-logo"></td>
          </tr>
          <tr>
            <th>住所</th>
            <td>{{"〒". $item->merchant->postal_code ." ". $item->merchant->prefecture . $item->merchant->city . $item->merchant->address }}</td>
          </tr>
          <tr>
            <th>電話番号</th>
            <td>{{ $item->merchant->tel }}</td>
          </tr>
        </table>
        <!-- end seller info -->

  
      </div>
      <!-- rigtht end  -->
      <div class="clear-fix"></div>
      <div class="item-price">   
          <h4>{{ number_format($item->sell_price) }}円(税込)</h4>
      </div>
      <div class="purchase">
        <form method="get" action="{{ url('/shop/cart/2') }}" class="purchase">
 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
          <input type="hidden" value="{{ $item->id }}" name="id" class="btn">     
          <input type="submit" value="確認して購入 (デモ！)" id="purchase" class="btn">
        </form>
      </div>

    </div>
    <!-- item detail end -->
  </div>
  <!-- end item&#45;wrapper -->
@endsection
