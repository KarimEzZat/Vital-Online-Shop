@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                {{ isset($product)? 'Update Product' : 'Create New Product' }}
            </div>
            <div class="card-body">
                @include('partials.errors')
                <form action="{{ isset($product)? route('products.update', $product->id) : route('products.store') }}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ isset($product)? $product->name : old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control"
                               value="{{ isset($product)? $product->price : old('price')}}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        @if(isset($product))
                            <img src="{{ asset('uploads/products-imgs/'.$product->image) }}" alt="" class="img-fluid">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="5" rows="5"
                                  class="form-control">{{ isset($product)? $product->description : old('description') }}</textarea>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">
                            {{ isset($product)? 'Update Product' : 'Create Product' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
