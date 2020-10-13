@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card">
        <div class="card-header">
            Update Your Profile
        </div>

        <div class="card-body">
            <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}"class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="avatar">Upload New Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                </div>
                <div class="form-group">
<<<<<<< HEAD
=======
                    <label for="about">About You</label>
                <textarea name="about" id="about" cols="6" rows="6" class="form-control"></textarea>
                </div>

                <div class="form-group">
>>>>>>> a2a41f015e4ab3f41219eff03408fdec4f4536fa
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update Profile</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection