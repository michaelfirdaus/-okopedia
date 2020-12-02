@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($histories as $history)
            <div class="col-md-12 @if (!$loop->first) my-3 @endif">
                <div class="card">
                    <div class="card-header bg-success text-white">
                    Transaction History
                    </div>
                    <div class="card-body">
                    <a href="{{ route('user.transaction.history.detail', $history->id) }}" class="text-secondary">{{ $history->created_at }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
