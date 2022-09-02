@extends('admin.layouts.app')


@section('title')
    Admins | My Resort
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h3 class="text-center py-3 bg-light rounded"> Add Admin</h3> 
        @if(Session::has('fail'))
          <div class="alert alert-danger" role="alert">
              {{Session::get('fail')}}
          </div>
        @elseif(Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
          </div>
        @endif
        
        <form action="{{route('admin.addAdmin')}}" method="POST">
          @csrf
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{old('name')}}" required>
                  @error('name')
                    <div class="text-danger">
                      {{$message}}
                    </div>
                  @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="name@email.com" value="{{old('email')}}" required>
                @error('email')
                <div class="text-danger">
                  {{$message}}
                </div>
                @enderror
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="mobile">Mobile</label>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="017xxxxxxxx" value="{{old('mobile')}}" required>
                  @error('mobile')
                  <div class="text-danger">
                    {{$message}}
                  </div>
                  @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationServer03">Address</label>
              <input type="text" class="form-control " name="address" id="validationServer03" placeholder="Address" required>
                @error('address')
                <div class="text-danger">
                  {{$message}}
                </div>
                @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
              
                @error('password')
                <div class="text-danger">
                  {{$message}}
                </div>
                @enderror
             
            </div>
          </div>

          <button class="btn btn-primary " type="submit">Submit form</button>
        </form>
      </div>
    </div>
  </div>
@endsection


@section('script')
    
@endsection