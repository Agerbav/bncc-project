@extends('layout.main-layout')

@section('title', 'Admin Page')

@section('content')
  <div class="mt-5 mb-3 col-5 m-auto container text-center">
    <div>
      <h1>This is the admin Page</h1>
    </div>
    <div class="mt-5 container text-center">
      <a href="admin-page/add-item" type="button" class="btn btn-primary"> Add Item </a>
    </div>
    @if (Session::has('status'))
      <div class="alert alert-success mt-5" role="alert">
         {{Session::get('message')}}
      </div>
    @endif
  </div>
  
  
  <div class="my-5 col-8 mx-auto">
    <form action="" method="get">
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="keyword" placeholder="Search for Item">
        <button class="input-group-text btn btn-primary">Search</button>
      </div>
    </form>  
  </div>

  <div class="mt-5 mb-3 m-auto text-center">
    <table class="table table-bordered">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
      @foreach ($itemList as $item)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->categories->name}}</td>
        <td>{{$item->count}}x</td>
        <td>Rp. {{$item->price}}</td>
        <td>
          <a href="item/{{$item->id}}" type="button" class="btn btn-link btn-sm">Details</a>
          <a href="admin-page/update-item/{{$item->id}}" type="button" class="btn btn-link btn-sm">Update</a>
          <a href="admin-page/delete-item/{{$item->id}}" type="button" class="btn btn-danger btn-sm">Delete Item</a>
        </td>
      </tr>
      @endforeach
    </table>
    <ol>
      @foreach ($itemList as $item)
      @endforeach
    </ol>   
  </div>
  <div class="mt-5 container text-center">
    {{$itemList->withQueryString()->links()}}
  </div>
@endsection