@extends('layouts.users')
@section('title')
   Categories 
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header card-header-primary">

            @include('messages.errorMessage')
            @include('messages.successMessage')

            <h4 class="card-title ">All Categories</h4>
            <div class="text-right">
                <a href="{{ route('categories.create') }}" class="btn btn-success">
                        Create New Category
                </a>
                </div> 
        </div><br>



        @if ($categories && $categories->count() > 0)
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
                        Status
                    </th>
                  <th>
                    Photo
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
                    @foreach ($categories as $cat)
                    <tr>
                        <td>
                          {{ $x ++ }}
                        </td>
                        <td>
                          {{ $cat->name }}
                        </td>
                        <td>
                          {{ $cat->status() }}
                        </td>
                        <td>
                            <img src="{{ asset('assets/images/'. $cat->photo) }}" alt="Logo Product" style="height: 100px; width:100px">
    
                        </td>
                        <td class="text-primary">
                            <a href="{{ route('categories.edit',$cat->id) }}" class="btn btn-primary">
                                Edit
                            </a>
                            <a href="{{ route('categories.status',$cat->id) }}" class="btn btn-primary">
                                @if ($cat->active == 1)
                                    Un Activate
                                @else
                                    Activate
                                @endif
                            </a>
                            <a href="{{ route('categories.delete',$cat->id) }}" class="btn btn-danger">
                                Delete
                            </a>
                          
                        </td>
                        
                      </tr> 
                    @endforeach
                </tbody>
              </table>

              {{ $categories->links() }}
            </div>
          </div>
        @else
          <h1 class="text-center">
              No Categories
          </h1>
        @endif









      
    </div>
  </div>
@endsection