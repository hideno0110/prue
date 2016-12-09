@extends('layouts.shopDefault')

@section('title', 'Prue')
@section('header-right')
@endsection

@section('content')

  <div class="items-wrapper">
    @foreach($items as $item) 
      <a href="{{ url('/',$item->id) }}">
      <div class="item">
        <div class="item_pic">
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
        </div>
        <div class="item_name">{{ $item->item_master->name }}</div>
        <div class="item_price">{{ number_format($item->sell_price) }}円</div>
      </div>
      </a>
    @endforeach
  </div>
  <div class="render">
    <p> {{$items->render()}}</p>
  </div>


<script>
jQuery(function($) {
  $('.item_name').each(function() {
    var $target = $(this);
 
    // オリジナルの文章を取得する
    var html = $target.html();
 
    // 対象の要素を、高さにautoを指定し非表示で複製する
    var $clone = $target.clone();
    $clone
      .css({
        display: 'none',
        position : 'absolute',
        overflow : 'visible'
      })
      .width($target.width())
      .height('auto');
 
    // DOMを一旦追加
    $target.after($clone);
 
    // 指定した高さになるまで、1文字ずつ消去していく
    while((html.length > 0) && ($clone.height() > $target.height())) {
      html = html.substr(0, html.length - 1);
      $clone.html(html + '...');
    }
 
    // 文章を入れ替えて、複製した要素を削除する
    $target.html($clone.html());
    $clone.remove();
  });
});
</script>
@endsection
