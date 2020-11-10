@extends('layouts.users')
@section('title')
    Update Category {{ $category->name }}
@endsection



@section('content')

   

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Update Category {{ $category->name }}</h4>
                <p class="card-category">Update Category {{ $category->name }}</p>
            
            </div>

            <div class="card-body"><br>

                <div class="text-center">
                    <img src="{{ asset('assets/images/'. $category->photo) }}" alt="Logo Category" style="height: 100px; width:100px">
                </div><br><br>
                
                
                
                    

                        <form action="{{ route('categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="form-body">
                                

                                    <input type="hidden" name="id" value="{{ $category->id }}">

                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Category Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                            @error("name")
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="name">Category Logo</label>
                                            <input type="file" name="photo">
                                            @error('photo')
                                            <small id="emailHelp" class="form-text text-danger text-center">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div> 

                                        <div class="col-md-6">
                                            <div class="form-group mt-1">
                                                <input type="checkbox"  value="1" 
                                                    name="active"
                                                    id="switcheryColor4"
                                                    class="switchery" data-color="success"
                                                    @if ($category->active == 1)
                                                        checked
                                                    @endif/>
                                                <label for="switcheryColor4"
                                                    class="card-title ml-1">Status </label>
                                            </div>
                                        </div>

                                        

                                    </div>

                                    <button type="submit" class="btn btn-primary pull-right">Update Category</button>
                                    <div class="clearfix"></div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
                 
@endsection