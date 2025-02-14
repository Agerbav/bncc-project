@extends('layout.main-layout')
@section('title', 'Admin Page | Update Item')
@section('content')

  <div class="mt-5 mb-3 col-8 m-auto container text-center">
    <h1>Are you sure you want to delete "{{$item->name}}"</h1>
  </div>
  <div class="mt-5 mx-auto text-center">
      <a href="/admin-page" type="button" class="btn btn-primary btn-lg">Cancel</a>
      <form style="display: inline-block" action="/admin-page/destroy/{{$item->id}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-lg">Delete</button>
      </form>
  </div>
  </div>

@endsection