@extends('layout.logout-layout')
@section('title', 'Login')
@section('content')
  <div class="mt-5 mb-3 col-5 m-auto container text-center">
    <h1>This is the login page</h1>
  </div>
  <div class="mt-5 mb-3 col-5 m-auto">
    <form method="POST" action="">
      @if (Session::has('status'))
        <div class="alert alert-danger mt-5" role="alert">
           {{Session::get('message')}}
        </div>
      @endif
      @csrf
      <!-- this is input email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name='email' placeholder="name@example.com" required>
      </div>
      <!-- this is input password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" class="form-control" name='password' required>
      </div>
      <!-- this is submit button -->
      <div class="mb-3">
        <button type="submit" class="btn btn-success">Login</button>
      </div>
    </form>
  </div>

  
@endsection
