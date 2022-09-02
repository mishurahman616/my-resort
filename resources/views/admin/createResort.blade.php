@extends('admin.layouts.app')

@section('title')
Add Resort | My Resort
@endsection



@section('content')
<div class="container">
    <div class="row">
      <div class="col">
        <h3 class="text-center py-3 bg-light rounded"> Add Resort</h3> 
        @if(Session::has('fail'))
          <div class="alert alert-danger" role="alert">
              {{Session::get('fail')}}
          </div>
        @elseif(Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
          </div>
        @endif
        
        <form action="{{route('admin.addResort')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="type">Resort Type</label>
              <input type="text" class="form-control"  name="type" id="type" placeholder="Resort Type" value="{{old('type')}}" required>
                  @error('type')
                    <div class="text-danger">
                      {{$message}}
                    </div>
                  @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="desc">Description</label>
              <input type="text" class="form-control" name="desc" id="desc" placeholder="Description" value="{{old('desc')}}" required>
                @error('desc')
                <div class="text-danger">
                  {{$message}}
                </div>
                @enderror
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="room">Number of Rooms</label>
                <input type="text" class="form-control" name="room" id="room" placeholder="Number of Rooms" value="{{old('room')}}" required>
                  @error('room')
                  <div class="text-danger">
                    {{$message}}
                  </div>
                  @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="price">Per night Per Room Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Price (BDT)" value="{{old('price')}}" required>
                  @error('price')
                  <div class="text-danger">
                    {{$message}}
                  </div>
                  @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="images">Images</label>
              <input class="form-control"  type="file" multiple="multiple" id="images" name="images[]" accept="image/*" > <br/>
              @error('images')
              <div class="text-danger">
                {{$message}}
              </div>
              @enderror
          </div>
          </div>

          <button class="btn btn-primary " type="submit">Save Resort</button>
        </form>
      </div>
    </div>
  </div>
@endsection




@section('script')

@endsection