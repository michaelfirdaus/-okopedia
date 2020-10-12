@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card">
        <div class="card-header">
            Update Product : {{ $product->name }}
        </div>

        <div class="card-body">
            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Product Image</label>
                    <input type="file" name="name" value="{{ $product->product_image }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" value="{{ $product->product_name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Product Category</label>
                    <input type="text" name="name" value="{{ $product->product_category }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Product Price</label>
                    <input type="text" name="name" value="{{ $product->product_price }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Product Description</label>
                    <input type="text" name="name" value="{{ $product->product_description }}" class="form-control">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update Product</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection