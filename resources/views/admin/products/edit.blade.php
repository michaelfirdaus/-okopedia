@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card">
        <div class="card-header">
            Update Product : {{ $product->product_name }}
        </div>

        <div class="card-body">
            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="product_image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="product_category">Product Category</label>
                    <select name="product_category" id="product_category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" name="product_price" value="{{ $product->product_price }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="product_desc">Product Description</label>
                    <input type="text" name="product_desc" value="{{ $product->product_desc }}" class="form-control">
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