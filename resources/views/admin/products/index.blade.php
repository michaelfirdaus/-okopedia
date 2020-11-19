@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card card-header">
            <th><strong>All Products</strong></th>
        </div>
        <div class="card card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Product Id
                    </th>
                    <th>
                        Product Image
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Product Category
                    </th>
                    <th>
                        Product Price
                    </th>
                    <th>
                        Product Description
                    </th>
                    <th>
                        Editing
                    </th>
                    <th>
                        Delete
                    </th>
                </thead>
        
                <tbody>
                    @if($products->count() > 0)
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    <img src="{{ url($product->product_image) }}" width="50">
                                </td>
                                <td>
                                    {{ $product->product_name }}
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td>
                                    {{ $product->product_price }}
                                </td>
                                <td>
                                    {{ $product->product_desc }}
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', ['id' => $product ->id]) }}" class="btn btn-xs btn-info">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('product.delete', ['id' => $product ->id]) }}" class="btn btn-xs btn-danger">
                                        <span class="fas fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="8" class="text-center">No data available, try add some new product.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection