@extends('layouts.app')

@section('content')

    @if(Auth::check())
        <div class="card">
            <div class="card-header font-weight-bold">Products</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                @foreach($products as $product)
                    <div class="col">
                        <div class="card card-body m-4">
                            <img src="{{ url($product->product_image) }}" alt="{{ $product->product_name }}" class="img-thumbnail" width="300">
                            <div class="my-2">
                                <h4 class="text-primary font-weight-bold my-3">{{$product->product_name}}</h4>
                                <p class="text-secondary">{{$product->product_price}}</p>
                                <p class="text-info">{{$product->category->name}}</p>
                            </div>
                            <a href="{{ route('user.productdetail', ['id' => $product->id]) }}" class="btn btn-success">Product Detail</a>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">{{$products->links()}}</div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card card-body m-4">
                        <img src="{{ url($product->product_image) }}" alt="{{ $product->product_name }}" class="img-thumbnail d-flex justify-items-center align-items-center">
                        <div class="my-2">
                            <h4 class="text-primary font-weight-bold my-3">{{$product->product_name}}</h4>
                            <p class="text-secondary">IDR {{$product->product_price}}</p>
                            <p class="text-info">{{$product->category->name}}</p>
                        </div>
                        <a href="{{ route('user.productdetail', ['id' => $product->id]) }}" class="btn btn-success">Product Detail</a>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12">
                <div class="d-flex justify-content-center">{{$products->links()}}</div>
            </div>
        </div>
    @endif
    
@endsection
