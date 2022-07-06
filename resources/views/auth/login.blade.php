@extends('layouts.main')

@section('content')

  @if(session()->has('register_success'))
    <div class="alert alert-success" role="alert">
        {{ session('register_success') }}
    </div>
  @endif
  @if(session()->has('login_fail'))
    <div class="alert alert-danger" role="alert">
        {{ session('login_fail') }}
    </div>
  @endif

  <main class="w-100 m-auto d-flex justify-content-center mt-5">
    <form action="/login" method="post">
      @csrf
      <h1 class="h3 mb-3 fw-normal d-flex justify-content-center">Login</h1>
  
      <div class="mb-1">
        <label for="floatingInput">Email address</label>
        <input type="email" name="email" class="mb-3 form-control @error('email') is-invalid @enderror" autofocus>
      </div>
      @error('email')
        <div class="text-danger">
            {{ $message }}
        </div>
      @enderror

      <div class="">
        <label for="floatingPassword">Password</label>
        <input type="password" name="password" class="mb-3 form-control @error('password') is-invalid @enderror">
      </div>
      @error('password')
        <div class="text-danger">
            {{ $message }}
        </div>
      @enderror
  
      <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Login</button>
      <p class="text-muted px-5">Doesn't have account? <a class="text-decoration-none" href="/register">Register</a></p>
    </form>
  </main>

@endsection