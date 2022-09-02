@extends('site.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($resorts as $resort)
        <div class="card col-md-3">
          <div class="card-body">
            <h5>{{$resort->type}}</h5>
            <p>{{$resort->desc}}</p>
          </div>
          <div class="card-footer">
            <p>Per night per room Cost: {{$resort->price}}</p>
            <a href="{{url('resortDetails/'.$resort->id)}}" class="btn btn-info" data-id="{{$resort->id}}">Detials</a>

          </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
@endsection