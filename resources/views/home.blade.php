@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header bg-primary text-center">{{ __('PUBLISHED POSTS') }}</div>

                <div class="card-body">
                    <h1 class="card-text text-primary text-center"> {{ $posts_count }}</h1>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header bg-success text-center">{{ __('USERS') }}</div>

                <div class="card-body">
                    <h1 class="card-text text-success text-center"> {{ $users_count }}</h1>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header bg-danger text-center">{{ __('DELETED POSTS') }}</div>

                <div class="card-body">
                    <h1 class="card-text text-danger text-center"> {{ $trashed_count }}</h1>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header bg-warning text-center" >{{ __('CATEGORIES') }}</div>

                <div class="card-body">
                   <h1 class="card-text text-warning text-center"> {{ $categories_count }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
