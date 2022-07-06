@extends('layouts.main')

@section('content')
<main class="w-100 m-auto d-flex justify-content-center mt-5">
    <form action="/register" method="post">
      @csrf
      <h1 class="h3 mb-3 fw-normal d-flex justify-content-center">Register</h1>

      <div class="mb-1">
        <label for="floatingInput">Name</label>
        <input type="name" class="mb-3 form-control @error('name') is-invalid @enderror"
          name='name' value="{{ old('name') }}" autofocus>
      </div>
      @error('name')
        <div class="text-danger">
            {{ $message }}
        </div>
      @enderror
      
      <div class="mb-1">
        <label for="floatingInput">Username</label>
        <input type="username" class="mb-3 form-control @error('username') is-invalid @enderror"
          name="username" value="{{ old('username') }}">
      </div>
      @error('username')
        <div class="text-danger">
            {{ $message }}
        </div>
      @enderror
  
      <div class="mb-1">
        <label for="floatingInput">Email address</label>
        <input type="email" class="mb-3 form-control @error('email') is-invalid @enderror"
          name="email" value="{{ old('email') }}">
      </div>
      @error('email')
        <div class="text-danger">
            {{ $message }}
        </div>
      @enderror

      <div class="">
        <label for="floatingPassword">Password</label>
        <input type="password" class="mb-3 form-control @error('password') is-invalid @enderror"  
          name="password" value="{{ old('password') }}">
      </div>
      @error('password')
        <div class="text-danger">
            {{ $message }}
        </div>
      @enderror
  
      <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Login</button>
      <p class="text-muted px-5">Already have account? <a class="text-decoration-none" href="/login">Login</a></p>
    </form>
  </main>
@endsection