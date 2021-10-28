@extends('layouts.app')

@section('content')
    <h1 class="text-center  my-3"> Edit A Post

    </h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
    
            <div class="card card-default">
                <div class="card-header">
                    Edit Post: {{ $post->title}}
        
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
                    <form action="{{ route('post.update', ['id' => $post->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group my-1">
                            <label for="title"> Title </label>
                            <input type="text" value="{{ $post->title}}" class="form-control" placeholder=" Post's Title" name="title">
                        </div>
                        <div class="form-group my-2">
                            <label for="category_id"> Select post category</label>
                            <select  class="form-control" id="category" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id}}"
                                    @if ($post->category->id == $category->id)
                                        selected
                                        
                                    @endif    
                                    > {{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="tag checkbox"> Select a Tag</label>
                            @foreach ($tags as $tag)
                                
                            <div class="checkbox">
                                <label for="tags"><input type="checkbox" value="{{ $tag->id }}" name="tags[]" id=""
                                @foreach ($post->tags as $item)

                                    @if ($tag->id == $item->id)
                                        checked                                            
                                    @endif
                                @endforeach
                                >  {{ $tag->tag}}</label>
                            </div>
                            @endforeach
                        </div>
    
                        <div class="form-group my-2">
                            <label for="content"> Content</label>
                            <textarea name="content"  value="" id="content" placeholder="Post Content" cols="30" rows="10" class="form-control">{{ $post->content}}</textarea>
                        </div>
                        <div class="form-group my-2">
                            <label for="image"> Featured Image</label>
                            <input type="file" value="{{ $post->image}}" name="image" id="image" placeholder="Featured Image" class="form-control">
                        </div>
                        <div class="form-group my-2">
                            <label for="description"> description</label>
                            <textarea name="description" value="" id="description" placeholder="describe image" cols="30" rows="10" class="form-control">{{ $post->description}}</textarea>
                        </div>
                        
                        <div class="form-group float-end" >
                            <button type="submit" class="btn btn-success">
                                Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    
        </div>
    </div>

@endsection