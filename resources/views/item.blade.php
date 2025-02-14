@extends('layout.main-layout')

@section('title', 'Details')

@section('content')
  <br>  
  <h2>
    This is the detail page for {{$item->name}}
  </h2>
  <div>
    @if ($item->image_path != '')
      <img src="{{asset(path: 'storage/images/'.$item->image_path)}}" alt="" width="200px"> <br>
    @else
      <img src="{{asset(path: '/default-featured-image.png')}}" alt="" width="200px"> <br>
    @endif
  </div>
  <div>
    This item costs Rp{{$item->price}} <br>
    This item is a {{$item->categories->name}} item <br>
    This item has {{$item->count}} item(s) in stock <br>
    Item description : {{$item->description}} <br>
  </div>
@endsection