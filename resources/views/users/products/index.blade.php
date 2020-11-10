@extends('layouts.users')
@section('title')
   Products 
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header card-header-primary">

            @include('messages.errorMessage')
            @include('messages.successMessage')

            <h4 class="card-title ">All Products</h4>
            <div class="text-right">
                <a href="{{ route('products.create') }}" class="btn btn-success">
                        Create New Product
                </a>
                </div> 
        </div><br>
        @if ($products && $products->count() > 0)
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="">
                    <tr>
                    <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            category Name
                        </th>   
                        <th>
                            Status
                        </th>
                        <th>
                            Controles
                        </th>
                    </tr>
                </thead>
                    <tbody>
                        @php
                            $x = 1;
                        @endphp
                        @foreach ($products as $pro)
                        <tr>
                            <td>
                                {{ $x ++ }}
                            </td>
                            <td>
                                {{ $pro->name }}
                            </td>
                            <td>
                                {{ $pro->price }}
                            </td>
                            <td>
                                {{ $pro->category['name'] }}
                            </td>
                            <td>
                                {{ $pro->status() }}
                            </td>
                            
                            <td class="text-primary">
                                <a href="{{ route('products.edit',$pro->id) }}" class="btn btn-primary">
                                    Edit
                                </a>
                                <a href="{{ route('products.status',$pro->id) }}" class="btn btn-success">
                                    @if ($pro->active == 1)
                                        Un Activate
                                    @else
                                        Activate
                                    @endif
                                </a>
                                <a href="{{ route('products.delete',$pro->id) }}" class="btn btn-danger">
                                    Delete
                                </a>
                            
                            </td>
                            
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
                </div>
            </div>
        @else
            <h1 class="text-center">
                No Products
            </h1>
        @endif

    
    </div>
  </div>
@endsection