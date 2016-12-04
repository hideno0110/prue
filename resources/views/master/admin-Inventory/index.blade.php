@extends('master.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <!-- <div class="col&#45;md&#45;8 col&#45;md&#45;offset&#45;2"> -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Inventories</div>

                <div class="panel-body">
                  
                  <table class="table">
                      <thead>
                      <tr>
                          <th>@sortablelink ('id')</th>
                          <th>Logo</th>
                          <th>Merchant</th>
                          <th>@sortablelink ('sku')</th>
                          <th>@sortablelink ('asin')</th>
                          <th>@sortablelink ('name')</th>
                          <th>Photo</th>
                          <th>SHOP_NAME</th>
                          <!-- <th>@sortablelink ('buy_date')</th> -->
                          <!-- <th>@sortablelink ('number')</th> -->
                          <!-- <th>@sortablelink ('buy_price')</th> -->
                          <!-- <th>@sortablelink ('sell_price')</th> -->
                          <!-- <th>@sortablelink ('payment')</th> -->
                          <!-- <th>@sortablelink ('sale_place')</th> -->
                          <!-- <th>@sortablelink ('condition')</th> -->
                          <!-- <th>@sortablelink ('DESCRIPTION')</th> -->
                          <!-- <th>@sortablelink ('MEMO')</th> -->
                          <!-- <th>@sortablelink ('free')</th> -->
                          <th>@sortablelink ('created_at')</th>
                          <th>@sortablelink ('updated_at')</th>
                          <th>update user</th>
                      </tr>
                      </thead>
                      <tbody>
              
              
                      @if($inventories)
                      @foreach($inventories as $inventory)
              
                        <tr class="inventory">
                          <td class="id">{{ $inventory->id }}</td>
                          <td class="id"><img src="{{ $inventory->merchant->photo->file }}" height="50"></td>
                          <td class="id">{{ $inventory->merchant->name }}</td>
                          <td> @if($inventory->sku2) {{$inventory->sku2 }}<br>(旧:{{$inventory->sku }}) @else {{$inventory->sku }} @endif</td>
                          <td><a href="{{ route('inventories.edit',$inventory->id)}}" alt="">{{ $inventory->asin }}</a></td>
                          <td><a href="{{ route('inventories.edit',$inventory->id)}}" alt="">{{ $inventory->name}}</a></td>
                          <td>
                            @foreach($inventory->inv_photo as $photo)
                              @if($photo->number == 1)
                                <a href="{{ route('inventories.edit',$inventory->id)}}" alt=""><img height="50" src="{{ $photo->file ? $photo->file : 'http://placehold.it/50x50' }}" alt="" class="img-rounded"></a>
                              @else
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $inventory->shop_id ? $inventory->shop->shop_list->shop_name : '' }} {{ $inventory->shop_id ? $inventory->shop->shop_branch_name : '' }}</td>
                          <td>{{ $inventory->buy_date }}</td>
                          {{--
                          <td>{{ $inventory->number }}</td>
                          <td>@if ($inventory->buy_price - $inventory->sell_price >= 0)
                                  <span class="label label-danger"> {{$inventory->buy_price}} </span>
                              @else {{$inventory->buy_price}}
                              @endif
                          </td>
                          <td>{{ $inventory->sell_price }}</td>
                          <td>{{ $inventory->payment_id ? $inventory->payment->name : '' }}</td>
                          <td>{{ $inventory->sale_place_id ? $inventory->sale_place->name : '' }}</td>
                          <td>@if ($inventory->condition_id == 11)
                                  <span class="label label-success">{{ $inventory->condition->name}}</span>
                              @elseif ($inventory->condition_id == 1)
                                  <span class="label label-primary">{{ $inventory->condition->name}}</span>
                              @elseif ($inventory->condition_id == 2)
                                  <span class="label label-info">{{ $inventory->condition->name}}</span>
                              @elseif ($inventory->condition_id == 3)
                                  <span class="label label-warning">{{ $inventory->condition->name}}</span>
                              @elseif ($inventory->condition_id == 4)
                                  <span class="label label-default">{{ $inventory->condition->name}}</span>
                              @else
                                  {{ $inventory->condition_id ? $inventory->condition->name : '' }}
                              @endif
                          </td>
                        - <td>{{ $inventory->description }}</td> 
                          <td class="memo">{{ $inventory->memo }}</td> 
                          <td class="free">{{ $inventory->free }}</td>
                        --}}
                          <td>{{ $inventory->created_at->diffForHumans() }}</td>
                          <td>{{ $inventory->updated_at->diffForHumans() }}</td>
                          <td>{{ $inventory->admin_id }}</td>
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                   <div class="col-sm-6 col-sm-offset-5">
                      {{$inventories->render()}}
                  </div>               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
