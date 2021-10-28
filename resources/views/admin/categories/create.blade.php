@extends('layouts.app')

@section('content')
    <h1 class="text-center  my-3"> Create A category

    </h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
    
            <div class="card card-default">
                <div class="card-header">
                    Create New Category
        
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
                    <form action="{{ route('category.store')}}" method="POST" >
                        @csrf
                        <div class="form-group my-1">
                            <label for="name"> Title </label>
                            <input type="text" class="form-control" placeholder=" Category name" name="name">
                        </div>
                        <div class="form-group float-end" >
                            <button type="submit" class="btn btn-success">
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    
        </div>
    </div>

@endsection