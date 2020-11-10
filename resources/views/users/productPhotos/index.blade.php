@extends('layouts.users')
@section('title')
   Products Photos 
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header card-header-primary">

            @include('messages.errorMessage')
            @include('messages.successMessage')

            <h4 class="card-title ">All  Products Photos </h4>
            <div class="text-right">
                <a href="{{ route('productPhotos.create') }}" class="btn btn-success">
                        Create  Product Photo 
                </a>
                </div> 
        </div><br>



        @if ($photos && $photos->count() > 0)
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            PHOTO
                        </th>
                        <th>
                            PRODUCT NAME
                        </th>
                        <th>
                            TYPE
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
                    @foreach ($photos as $image)
                    <tr>
                        <td>
                          {{ $x ++ }}
                        </td>
                        <td>
                            <img src="{{ asset('assets/images/'. $image->photo) }}" alt="Logo Product" style="height: 100px; width:100px">
    
                        </td>
                        <td>
                          {{ $image->product->name }}
                        </td>
                        <td>
                          {{ $image->type() }}
                        </td>
                        <td>
                          {{ $image->status() }}
                        </td>
                        
                        <td class="text-primary">
                            <a href="{{ route('productPhotos.edit',$image->id) }}" class="btn btn-primary">
                                Edit
                            </a>
                            <a href="{{ route('productPhotos.status',$image->id) }}" class="btn btn-success">
                                @if ($image->active == 1)
                                    Un Activate
                                @else
                                    Activate
                                @endif
                            </a>
                            <a href="{{ route('productPhotos.delete',$image->id) }}" class="btn btn-danger">
                                Delete
                            </a>
                          
                        </td>
                        
                      </tr> 
                    @endforeach
                </tbody>
              </table>

              {{ $photos->links() }}
            </div>
          </div>
        @else
          <h1 class="text-center">
              No Product Photos
          </h1>
        @endif









      
    </div>
  </div>
@endsection