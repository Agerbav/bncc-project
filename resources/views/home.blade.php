@extends('layout.main-layout')

@section('title', 'Homepage')

@section('content')
  
  <div class="my-5 m-auto container text-center">
    <div>
      <h1>This is the Homepage</h1>
      <h2>Welcome to BNCC SHOP!</h2>
      <h2>{{Auth::user()->name}}</h2>
    </div>
    @if (Session::has('status'))
      <div class="alert alert-success mt-5 col-5 container text-center" role="alert">
         {{Session::get('message')}}
      </div>
    @endif
    
    <div class="text-center">

      <div class="my-5 col-8 mx-auto">
        <form action="" method="get">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="keyword" placeholder="Search for Item">
            <button class="input-group-text btn btn-primary">Search</button>
          </div>
        </form>  
      </div>

      <div class="row g-2 align-items-start">
      @foreach ($itemList as $item)
        <div class="col-3">
          <div class="p-3">
            <a href="item/{{$item->id}}" type="button" class="btn btn-outline-dark">
              <div>
                @if ($item->image_path != '')
                  <img src="{{asset(path: 'storage/images/'.$item->image_path)}}" alt="" width="200px" height="200px"> <br>
                @else
                  <img src="{{asset(path: '/default-featured-image.png')}}" alt="" width="200px" height="200px"> <br>
                @endif
              </div>
              <div class="my-3">
                {{$item->name}} <br> {{$item->categories->name}} <br> Rp. {{$item->price}} <br> {{ $item->count }}x
              </div>
            </a>
            <div class="my-3">
              @if ($item->count > 0)
                <a href="add-to-cart/{{$item->id}}" type="button" class="btn btn-success">
                  Add to cart
                </a>
              @else
                <a href="#" type="button" class="btn btn-success">
                  Item Sold Out
                </a>
              @endif
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    <div class="mt-5 container text-center">
      {{$itemList->withQueryString()->links()}}
    </div>
  </div>
  <!-- <table class="table table-bordered text-center">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Category</th>
      <th>Price</th>
      <th>Action</th>
    </tr>
    @foreach ($itemList as $item)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->categories->name}}</td>
      <td>Rp. {{$item->price}}</td>
      <td><button type="button" class="btn btn-link">Add to cart</button> <a href="item/{{$item->id}}" type="button" class="btn btn-link">Details</a></td>
    </tr>
    @endforeach
  </table>
  <ol>
    @foreach ($itemList as $item)
    @endforeach
  </ol> -->
@endsection

