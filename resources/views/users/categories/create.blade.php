@extends('layouts.users')

@section('title')
    Create Category
@endsection

@section('content')
    <h1>Create New Category</h1>

    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Edit Profile</h4>
            <p class="card-category">Complete your profile</p>
          </div>
          <div class="card-body">


            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Category Name</label>
                    <input type="text" class="form-control" name="name">
                  </div>
                    @error('name')
                    <small id="emailHelp" class="form-text text-danger text-center">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="name">Company Logo</label>
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
                            checked/>
                        <label for="switcheryColor4"
                            class="card-title ml-1">Status </label>
                    </div>
                </div> 
              </div>
             
              <button type="submit" class="btn btn-primary pull-right">Create</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
@endsection