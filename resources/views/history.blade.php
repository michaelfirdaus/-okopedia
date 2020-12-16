@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        @if($histories->count() < 1)
            <div class="container my-5 d-flex justify-content-between">
                <h4 class="font-weight-bold text-danger text-center">Your history is still empty. Shop now and your product history will showed up here!</h4>
                <a href="{{ route('home') }}" class="btn btn-secondary">Back to home</a>
            </div>
        @else
            @foreach($histories as $history)
                <div class="col-md-12 @if (!$loop->first) my-3 @endif">
                    <div class="card">
                        <div class="card-header bg-success text-white font-weight-bold">
                            Transaction History
                        </div>
                        <div class="card-body">
                            <a href="{{ route('user.transaction.history.detail', $history->id) }}" class="text-secondary">{{ $history->created_at }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
