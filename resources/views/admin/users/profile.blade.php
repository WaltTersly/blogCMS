@extends('layouts.app')

@section('content')
    <h1 class="text-center  my-3"> My Profile

    </h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
    
            <div class="card card-default">
                <div class="card-header">
                    Edit Your Profile
        
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.profile.update')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group my-2">
                            <label for="name"> User </label>
                            <input type="text" class="form-control" value="{{ $user->name }}" placeholder=" User name" name="name">
                        </div>
                        <div class="form-group my-2">
                            <label for="email"> Email </label>
                            <input type="email" class="form-control" value="{{ $user->email }}" placeholder=" hehehe@example.com" name="email">
                        </div>
                        <div class="form-group my-2">
                            <label for="password"> New Password </label>
                            <input type="password" class="form-control" placeholder="" name="password">
                        </div>
                        <div class="form-group my-2">
                            <label for="password-confirm"> Confirm_New_Password </label>
                            <input type="password" d="password-confirm" class="form-control" placeholder="" name="password_confirmation">
                        </div>
                        <div class="form-group my-2">
                            <label for="avatar"> Upload Avatar </label>
                            <input type="file" class="form-control" placeholder="" name="avatar">
                        </div>
                        <div class="form-group my-2">
                            <label for="facebook"> Facebook </label>
                            <input type="text" class="form-control" value="{{ $user->profile->facebook }}" placeholder="" name="facebook">
                        </div>
                        <div class="form-group my-2">
                            <label for="youtube"> Youtube </label>
                            <input type="text" class="form-control" value="{{ $user->profile->youtube }}" placeholder=" " name="youtube">
                        </div>
                        <div class="form-group my-2">
                            <label for="about"> About Me</label>
                            <textarea name="about" id="about" placeholder="" cols="10" rows="10" class="form-control">{{ $user->profile->about }} </textarea>
                        </div>
                        <div class="form-group float-end" >
                            <button type="submit" class="btn btn-success">
                                Save Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    
        </div>
    </div>

@endsection