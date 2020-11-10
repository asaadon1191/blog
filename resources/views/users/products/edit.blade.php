@extends('layouts.users')

@section('title')
    Create Product
@endsection

@section('content')
    <h1>Create New Product</h1>

    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Create New Product</h4>
            <p class="card-Product">New Product</p>
          </div>
          <div class="card-body">


            <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

              <div class="row">

                <input type="hidden" value="{{ $product->id }}" name="id">
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Product Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                  </div>
                    @error('name')
                    <small id="emailHelp" class="form-text text-danger text-center">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                        <label class="">Select Category</label><br>
                        <select name="category_id" class="form-control" style="background-color: #3C4858">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" 
                                    @if ($cat->id == $product->category_id)
                                        selected
                                    @endif>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small id="emailHelp" class="form-text text-danger text-center">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                   
                </div>

                {{--  <div class="col-md-6">
                    <label for="name">Company Logo</label>
                      <input type="file" name="photo">
                    @error('photo')
                      <small id="emailHelp" class="form-text text-danger text-center">
                          {{ $message }}
                      </small>
                    @enderror
                </div>  --}}

                <div class="col-md-6">
                    <label>
                        Product Price
                    </label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                    @error('price')
                        <small id="emailHelp" class="form-text text-danger text-center">
                            {{ $message }}
                        </small>
                    @enderror
                </div> 

                <div class="col-md-6">
                    <div class="form-group mt-1">
                        <label for="switcheryColor4" class="card-title ml-1">
                            Status 
                        </label><br>
                        <input type="checkbox"
                            @if ($product->active == 1)
                                checked
                            @endif
                            name="active"
                            id="switcheryColor4"
                            class="switchery" data-color="success"
                            <checked><br>
                      
                    </div>
                </div> <br><br><br><br>

                <div class="col-md-12">
                    <div class="form-group mt-1">
                        <label  class="card-title ml-1">
                            Product Description 
                        </label>
                        <textarea name="desc" id="" cols="30" rows="10" class="form-control">
                            {{ $product->desc }}
                        </textarea>
                        @error('desc')
                            <small id="emailHelp" class="form-text text-danger text-center">
                                {{ $message }}
                            </small>
                        @enderror
                      
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