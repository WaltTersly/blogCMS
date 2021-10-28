@extends('layouts.frontend')

@section('content')
    <!-- Stunning Header -->

<div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
        <h1 class="stunning-header-title"> Search Results: {{ $tafuta }} </h1>
    </div>
</div>

{{-- post details  for each category--}}

<div class="container">
    <div class="row medium-padding120">
        <main class="main">
            
            <div class="row">
                @if ($posts-> count() > 0)
                    <div class="case-item-wrap">
                        @foreach ($posts as $post)
                            
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="case-item">
                                <div class="case-item__thumb">
                                    <img src=" {{ $post->image }} " alt=" {{ $post->title }} ">
                                </div>
                                <h6 class="case-item__title"><a href="{{ route('post.single', ['slug' => $post->slug ]) }}"> {{ $post->title }} </a></h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                @else
                   <h1 class="text-center" >
                       NO RESULTS FOUND
                    </h1> 
                @endif
            </div>

            <!-- End Post Details -->
            <br>
            <br>
            <br>
            <!-- Sidebar-->

            <div class="col-lg-12">
                <aside aria-label="sidebar" class="sidebar sidebar-right">
                    <div  class="widget w-tags">
                        <div class="heading text-center">
                            <h4 class="heading-title">ALL BLOG TAGS</h4>
                            <div class="heading-line">
                                <span class="short-line"></span>
                                <span class="long-line"></span>
                            </div>
                        </div>
                        
                        @if ($posts->count() > 0)
                            <div class="tags-wrap">
                                @foreach ($post->tags as $tag)
                                <a href="{{ route('tag.single', ['id' => $tag->id ]) }}" class="w-tags-item"> {{ $tag->tag }} </a>
                                @endforeach 
                                
                            </div>
                            
                        @else
                            <h3 class="text-center">
                                No tags found
                            </h3>
                        @endif

                    </div>
                </aside>
            </div>

            <!-- End Sidebar-->

        </main>
    </div>
</div>

@endsection