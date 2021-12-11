@extends('layouts.app')

@section('content')


<!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
            <!-- Horizontal Form -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Products</h3>
                </div>
                <div class="block-content">
                    <form action="{{ isset($product) ? route('products.update',['id' => $product->id]) : route('products.store') }}" method="post" enctype="multipart/form-data">       
                      @csrf  

                    <div class="form-group row @error('name') is-invalid @enderror">
                        <label class="col-lg-3 col-form-label" for="name">Name</label>
                        <div class="col-lg-7">
                            <input type="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Enter Name" value="{{isset($product) ? $product->name : old('product') }}" >
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row @error('price') is-invalid @enderror">
                        <label class="col-lg-3 col-form-label" for="name">Price</label>
                        <div class="col-lg-7">
                            <input type="name" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" name="price" placeholder="Enter Price" value="{{isset($product) ? $product->price : old('product') }}" >
                            @if($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row @error('upc') is-invalid @enderror">
                        <label class="col-lg-3 col-form-label" for="name">Upc</label>
                        <div class="col-lg-7">
                            <input type="name" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" id="upc" name="upc" placeholder="Enter Upc" value="{{isset($product) ? $product->upc : old('product') }}" >
                            @if($errors->has('upc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('upc') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row @error('upc') is-invalid @enderror">
                        <label class="col-lg-3 col-form-label" for="name">Status</label>
                        <div class="col-lg-7">
                            <select class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }} user-status-select" id="status" name="status" >
                               
                                    <option disabled selected value>Select Status</option>
                                    @foreach($statuses as $status)
                                      <option value="{{ $status }}"  @if(isset($product) && $product->status == $status) selected @endif>{{ $status }}</option>
                                    @endforeach

                              
                            </select>
                        </div>
                    </div>

                    <div class="form-group row @error('name') is-invalid @enderror">
                        <label class="col-lg-3 col-form-label" for="name">Image</label>
                        <div class="col-lg-7">
                            <div class="input-group">
                                <div class="custom-file">
                                   <input type="file" name="image" class="form-control" value="{{isset($product) ? $product->image : old('image') }}"  @if(!isset($product))  @endif >
                                   @if(isset($product->image))
                                       <img src="{{asset('website/adminproduct/products/'.$product->image)}}" height="50px" width="50px">
                                    @endif
                                    @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                                       
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row ">
                        <div class="col-lg-9 ml-auto">
                            <button type="submit" class="btn btn-alt-primary">Add</button>
                        </div>
                    </div>
                </form>
               </div>
            </div>
            <!-- END Horizontal Form -->
        </div>
        <!-- END Bootstrap Design -->
    </div>
    <!-- END Page Content -->

@endsection