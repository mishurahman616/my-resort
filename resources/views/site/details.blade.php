@extends('site.layouts.app')

@section('title')
Details
@endsection


@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center py-3 bg-light rounded"> Resort Details</h3> 

        <div class="card ">
            <div class="card-header">
            {{$resort->type}}
            </div>
            <div class="card-body">
            <p class="card-text">{{$resort->desc}}</p>
            </div>
            <div class="row m-1">
                @foreach ($resortImages as $image)
                <div class="card col-md-3">
                  <div class="card-body">
                    <img class="card-img-top" src="{{$image->link}}" alt="Card image cap">
                  </div>
                </div>
                @endforeach
            </div>
            <div class="card-footer text-muted">
           <p> Price per night per room: {{$resort->price}}</p>
            <a href="#" class="btn btn-primary">Book Now</a>

            </div>
        </div>

    </div>
</div>
@endsection