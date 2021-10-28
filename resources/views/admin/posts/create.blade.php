@extends('layouts.app')

@section('content')
    <h1 class="text-center  my-3"> Create A Post

    </h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
    
            <div class="card card-default">
                <div class="card-header">
                    Create New Post
        
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
                    <form action="{{ route('post.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group my-1">
                            <label for="title"> Title </label>
                            <input type="text" class="form-control" placeholder=" Post's Title" name="title">
                        </div>
                        <div class="form-group my-2">
                            <label for="category_id"> Select post category</label>
                            <select  class="form-control" id="category" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id}}"> {{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="tag checkbox"> Select a Tag</label>
                            @foreach ($tags as $tag)
                                
                            <div class="checkbox">
                                <label for="tags[]"><input type="checkbox" value="{{ $tag->id }}" name="tags[]" id="">  {{ $tag->tag}}</label>
                            </div>
                            @endforeach
                        </div>
    
                        <div class="form-group my-2">
                            <label for="content"> Content</label>
                            <textarea name="content" id="content" placeholder="Post Content" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group my-2">
                            <label for="image"> Featured Image</label>
                            <input type="file" name="image" id="image" placeholder="Featured Image" class="form-control">
                        </div>
                        <div class="form-group my-2">
                            <label for="description"> description</label>
                            <textarea name="description" id="description" placeholder="describe image" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        
                        <div class="form-group float-end" >
                            <button type="submit" class="btn btn-success">
                                Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    
        </div>
    </div>

@endsection

