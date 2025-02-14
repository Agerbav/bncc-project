
@extends('layout.main-layout')
@section('title', 'Checkout')
@section('content')
  <div class="mt-5 mb-3 col-5 m-auto container text-center">
    <h1>This is the checkout page</h1>
    <h2>Invoice Number: {{ $invoiceNumber }}</h2>
  </div> 
  <div class="row my-5 m-auto text-center container justify-content-center">
    <div class="col-8">
      <ul class="list-group">
        @foreach ($cart->items as $item)
          <li class="list-group-item d-flex">
            <div class="mx-5 my-1">
              {{ $item['item']->name }} |
              {{ $item['item']->categories->name }} |
              {{ $item['qty'] }}x |
              Rp. {{ $item['item']->price * $item['qty']}} |
            </div>
          </li>
        @endforeach
        <li class="list-group-item d-flex">
          <div class="mx-5 my-1">
            Total Price : Rp. {{ $totalPrice }}
          </div>
        </li>
      </ul>
    </div>
  </div>

  <div class="my-5 col-5 m-auto">
    <form action="/checkout/{{$invoiceNumber}}" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- this is input address -->
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="address" class="form-control" id="address" name='address'>
      </div>
      <!-- this is input password -->
      <div class="mb-3">
        <label for="postcode" class="form-label">Postcode</label>
        <input type="postcode" id="postcode" class="form-control" name='postcode'>
      </div>
      <!-- this is submit button -->
      <div class="mb-3">
        <button type="submit" class="btn btn-success">Checkout</button>
      </div>
    </form>
    <div class="m-auto">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul></ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  </div>

  </div>
  
@endsection