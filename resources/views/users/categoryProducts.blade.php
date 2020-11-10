@extends('layouts.users')


@section('title')
    Category Products
@endsection

@section('navName')
Category Products
@endsection

@section('content')
    <div class="row">
        @foreach ($activeProduct as $pro)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pro->name }}</h5>
                        <p class="card-text">
                            {{ $pro->desc }}
                        </p>
                        <a href="#" class="btn btn-primary">
                            More Detailes
                        </a>
                    </div>
                </div>
            </div>
            
        @endforeach
        
    </div>
@endsection