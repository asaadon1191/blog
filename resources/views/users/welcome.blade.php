@extends('layouts.users')


@section('title')
    DashBoard
@endsection

@section('navName')
    Dashboard
@endsection

@section('content')
    <div class="row">
        @foreach ($categories as $cat)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('assets/images/'. $cat->photo) }}" class="card-img-top" alt="{{ $cat->name }}">
                    <div class="card-body">
                    <h5 class="card-title">{{ $cat->name }}</h5>
                    <a href="{{ route('showProducts',$cat->id) }}" class="btn btn-primary">Show All Products</a>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
@endsection