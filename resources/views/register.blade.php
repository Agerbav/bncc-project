@extends('layout.logout-layout')
@section('title', 'Register')
@section('content')
  <div class="mt-5 mb-3 col-5 m-auto container text-center">
    <h1>This is the register page</h1>
  </div>
  

  <div class="mt-5 mb-3 col-5 m-auto">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="register" method="post" enctype="multipart/form-data">
      @csrf
      <!-- this is input email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
      </div>
      <!-- this is input phone -->
      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input class="form-control" id="phone" placeholder="08xxxxxxxxxx" name="phone">
      </div>
      <!-- this is input username -->
      <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input class="form-control" id="name" placeholder="Username" name="name">
      </div>
      <!-- this is input password -->
      <label for="password" class="form-label">Password</label>
      <input type="password" id="password" class="form-control" name="password">
      <div id="passwordHelpBlock" class="form-text mb-3">
        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
      </div>
      <!-- this is submit button -->
      <div class="mb-3">
        <button type="submit" class="btn btn-success">Register</button>
      </div>
    </form>
  </div>
@endsection