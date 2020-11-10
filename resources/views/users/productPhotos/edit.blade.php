@extends('layouts.users')

@section('title')
    Update Product Photo 
@endsection

@section('content')
    <h2 class="text-center">
        Update  Product Photo {{ $photo->product->name }}
    </h2>

    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Product Photo</h4>
            <p class="card-category"> Update Product Photo</p>
          </div>
          <div class="card-body">
            <div class="text-center">
                <img src="{{ asset('assets/images/'. $photo->photo) }}" alt="Logo Category" style="height: 100px; width:100px">
            </div><br><br>

            <form action="{{ route('productPhotos.update',$photo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

              <div class="row">
                   <input type="hidden" value="{{ $photo->id }}" name="id">
                    <div class="col-md-6">
                        <label for="name">Product Photo</label>
                        <input type="file" name="photo">
                        @error('photo')
                        <small id="emailHelp" class="form-text text-danger text-center">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Product name</label>
                            <select name="product_id" class="form-control" style="background-color: #2d2d2d">
                                @foreach ($products as $pro)
                                    <option value="{{ $pro->id }}" 
                                        @if ($pro->id == $photo->product_id)
                                            selected
                                        @endif>
                                        {{ $pro->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('product_id')
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
                                @if ($photo->active == 1)
                                    checked
                                @endif/>
                            <label for="switcheryColor4"
                                class="card-title ml-1">Status </label>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group mt-1">
                            <input type="checkbox"  value="1" 
                                name="type"
                                id="switcheryColor4"
                                class="switchery" data-color="success"
                                @if ($photo->type == 1)
                                    checked
                                @endif/>
                            <label for="switcheryColor4"
                                class="card-title ml-1">Type </label>
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