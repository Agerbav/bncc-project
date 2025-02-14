
@extends('layout.main-layout')
@section('title', 'Admin Page | Update Item')
@section('content')
  <div class="mt-5 mb-3 col-8 m-auto container text-center">
    <h1>This is the update item page</h1>
  </div>

  <div class="mt-5 mb-3 col-5 m-auto">

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="/admin-page/update/{{$item->id}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <!-- this is input name -->
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input class="form-control" id="name" name="name" value="{{$item->name}}" required>
      </div>

      <!-- this is input category -->
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select name="category_id" id="category" class="form-select" required>
          <option value="{{$item->categories->id}}">{{$item->categories->name}}</option>
          @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>
      
      <!-- this is input price -->
      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <div class="input-group">
          <span class="input-group-text">Rp.</span>
          <input class="form-control" id="price" name="price" type="number" value="{{$item->price}}" required>
        </div>
      </div>

      <!-- this is input count -->
      <div class="mb-3">
        <label for="count" class="form-label">Quantity</label>
        <input class="form-control" id="count" name="count" type="number" value="{{$item->count}}" required>
      </div>

      <!-- this is input description -->
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" rows="3" name="description">{{$item->description}}</textarea>
      </div>

      <!-- this is input image-->
      <div class="mb-3">
        <label for="image" class="form-label">Image (optional)</label>
        <div class="input-group">
          <input type="file" class="form-control" id="image" name="image">
        </div>
      </div>

      <!-- this is submit button -->
      <div class="mb-3">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
  </div>
@endsection