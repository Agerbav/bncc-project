@extends('layout.main-layout')

@section('title', 'Homepage')

@section('content')
  <div class="my-5 m-auto container text-center">
    <h1>This is the cart page</h1>
    @if (!Session::has('cart'))
      <h2>No items in cart</h2>
    @elseif (Session::has('cart') && $cart->totalQty<=0)
      <h2>No items in cart</h2>
    @endif
    
  </div
  
  @if (Session::has('cart') && $cart->totalQty>0)
    <div class="row my-5 m-auto text-center container">
      <div class="col-25">
        <ul class="list-group">
          @foreach ($cart->items as $item)
            @if ($item['qty']>0)
              <li class="list-group-item d-flex">
                <div>
                  @if ($item['item']->image_path != '')
                    <img src="{{asset(path: 'storage/images/'.$item['item']->image_path)}}" alt="" width="150px" height="150px"> <br>
                  @else
                    <img src="{{asset(path: '/default-featured-image.png')}}" alt="" width="150px" height="150px"> <br>
                  @endif
                </div>
                <div class="mx-5 my-3">
                  {{ $item['item']->name }} <br>
                  {{ $item['item']->categories->name }} <br>
                  Rp. {{ $item['item']->price * $item['qty']}} <br>
                  <div class="my-1">
                    <a href="/decrease-cart/{{ $item['item']->id }}" type="button" class="btn btn-outline-success btn-sm">-</a> <span>  {{ $item['qty'] }}x  </span><a href="/increase-cart/{{ $item['item']->id }}" type="button"  class="btn btn-outline-success btn-sm">+</a>
                  </div>
                </div>
              </li>
            @endif
          @endforeach
          <!-- <li class="list-group-item mx-5">
            Total Price = Rp. {{$totalPrice}}
          </li> -->
        </ul>
        <div class="mx-5 my-5 text-center">
          <h4>Total Price: Rp. {{ $totalPrice }}</h4>
        </div>
        <div class="mx-5 my-3 text-center">
          <a href="/checkout" type="button" class="btn btn-success btn-lg">Checkout</a>
        </div>
      </div>
    </div>
  </div>
  @endif

@endsection