@extends('admin.layouts.app')

@section('title')
    Admin | Home
@endsection


@section('content')
<h1 class="text-center py-5 bg-light m-2 rounded">Dashboard | Admin area</h1> 

<div class="container-fluid">
    <div class="row">
        @foreach($summary as $key=>$value)
            <div class="col-md-3 mb-5">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">{{ucwords('total '.$key)}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$value}}</h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection



@section('script')
@endsection