@extends('layouts.shopDefault')

@section('title','購入完了ページ')

@section('content')

@if(session('flash_message'))
  <p class="flash_message">{{ session('flash_message') }}</p>
@endif
<h2>ご購入ありがとうございました</h2>

<div class="carts-wrapper">
  <table>
    <tr>
      <th></th>
      <th></th>
      <th>価格</th>
      <th>数量</th>
    </tr>
    @foreach($tmp_carts as $cart)
      <tr>
        <td class="cart_item_image"><img src="/images/"></td>
        <td class="cart_item_name">{{ $cart->inventory->name }}</td>
        <td class="cart_item_price">{{ $cart->inventory->sell_price }}</td>
        <td class="cart_item_amount">{{$cart->amount }}</td>
      </tr>
    @endforeach
    <tr>
      <td colspan="5" class="cart_total">合計 <span class="total_price">¥{{ number_format($total_price) }}</span></td>
    </tr>
  </table>
</div>
@endsection
