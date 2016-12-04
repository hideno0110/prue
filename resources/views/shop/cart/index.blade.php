@extends('layouts.shopDefault')

@section('title', 'ショッピングサイト　カート')

@section('content')

<div class="carts-wrapper">
  <table>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th>価格</th>
      <th>数量</th>
    </tr>
    @foreach($carts as $cart)
      <tr>
        <td class="cart_item_image"><img src="/images/"></td>
        <td class="cart_item_name">{{ $cart->inventory->name }}</td>
        <td class="cart_item_delete">
          <form method="post" action="{{ action('ShopCartController@delete',$cart->id) }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <input type="submit" value="削除">
          </form>
        </td>
        <td class="cart_item_price">{{ $cart->inventory->sell_price }}</td>
        <td class="cart_item_amount">
          <form method="post" action="{{ action('ShopCartController@update', $cart->id) }}">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <input type="text" value="{{ $cart->amount }}" name="amount">個
            <input type="submit" value="変更">
          </form>
        </td>
      </tr>
    @endforeach
    <tr>
      <td colspan="5" class="cart_total">合計 
        <span class="total_price">¥{{ number_format($total_price) }}</span></td>
    </tr>
  </table>
  <div class="purchase">
    <form method="post" action="{{ url('shop/cart/complete') }}" class="purchase">
      {{ csrf_field() }}
      <input type="submit" value="購入する" id="purchase" class="btn">
    </form>
  </div>
</div>
@endsection
