@extends('admin.layouts.login')

@section('title')
    Admin Login | My Resort
@endsection

@section('content')
<!-- Login Page Nav bar -->

<nav class="navbar navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand" href="{{url('/admin/dashboard')}}">
            <img src="{{asset('/adminPanel/images/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
            MyResort
        </a>
    </div>
  </nav>

  <!-- Login Form -->
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-8 m-5 mx-auto">
            <h3 class="text-center mb-5 ">Admin Login </h3>
            @if(Session::has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('fail')}}
                </div>
            @endif
            <form action="{{route('admin.loginCheck')}}" method="POST" class="loginForm">
                @csrf
                <div class="form-floating mb-3">
                    <label for="emailInput">Email address</label>
                    <input type="email" name="email"  class="form-control" id="emailInput" placeholder="name@example.com" value="{{old('email')}}" required>
                    <div class="text-danger">
                       @error('email')
                           {{$message}}
                       @enderror
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <label for="passwordInput">Password</label>
                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password"  required>
                    <div class="text-danger">
                        @error('password')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Login</button>

            </form>
        </div>
    </div>
</div>
@endsection