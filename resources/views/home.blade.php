@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="card card-header">
                <div class="card-header">Activity</div>

                <div class="card-body">
                <img src="{{ Auth::user()->profile_picture }}" alt="">
                 Welcome {{ Auth::user()->username }}

                <div>
                <div class="card-body">
                    <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">My Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="likes-tab" data-toggle="tab" href="#likes" role="tab" aria-controls="likes" aria-selected="false">Liked Posts</a>
                </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="posts" role="tabpanel">
                {{Auth::user()->posts()->count()}} Posts created
                @foreach (Auth::user()->posts as $post)
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $post->title }}
                        <div class="pull-right">
                       <div class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            <span class="caret"></span>
                           </a>

                           <ul class="dropdown-menu" role="menu">
                               <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li><br>
                               <li><a href="{{ route('post.edit', [$post->id]) }}">Edit Post</a></li><br>
                               <li>
                                   <a href="#" 
                                   onclick ="document.getElementById('delete').submit()">Delete Post</a>
                                   {!! Form::open(['method' => 'DELETE', 'id' => 'delete', 'route'=> 
                                    ['post.delete', $post->id]]) !!}
                                   {!! form::close() !!}
                                </li>
                           </ul>
                        </div>
                       </div>
                    </h3>
                </div>
                <div class="card-body">
                    {{ $post->body }}
                    </br>
                    Category: <div class="badge">{{ $post->category->name }}</div>
                </div>
                </div>
                @endforeach
                </div>
                <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                {{Auth::user()->comments()->count()}} Comments made
                    @foreach (Auth::user()->comments as $comment)
                    <div class="card">
                    <div class="card-body">
                        <div class="col-sm-9">
                            {{ $comment->comment }}
                        </div>
                        <div class="col-sm-3">
                            <small><a href="{{ route('post.show', [$comment->post->id]) }}">View Post</a></small>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="category-tab">
                    {{Auth::user()->categories()->count()}} Categories created
                    @foreach (Auth::user()->categories as $category)
                    <div class="card">
                        <div class="card-body">
                        {{ $category->name }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="likes" role="tabpanel" aria-labelledby="likes-tab">
                    @foreach (Auth::user()->likes as $like)
                        @if ($like->like)
                        <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                       Created by {{ $post->user->username }}, {{ $post->title }}
                       <div class="pull-right">
                       <div class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            <span class="caret"></span>
                           </a>

                           <ul class="dropdown-menu" role="menu">
                               <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li><br>
                               <li><a href="{{ route('post.edit', [$post->id]) }}">Edit Post</a></li><br>
                               <li>
                                   <a href="#" 
                                   onclick ="document.getElementById('delete').submit()">Delete Post</a>
                                   {!! Form::open(['method' => 'DELETE', 'id' => 'delete', 'route'=> 
                                    ['post.delete', $post->id]]) !!}
                                   {!! form::close() !!}
                                </li>
                           </ul>
                        </div>
                       </div>
                    </h3>
                </div>
                <div class="card-body">
                    {{ $post->body }}
                    @if ($post->image != null)
                        <img src="/images/{{ $post->image }}" alt="Image" width="100%" height="600">
                    @endif
                    <br />
                    Category: <div class="badge">{{ $post->category->name }}</div>
                </div>
                <div class="card-footer" data-postid="{{ $post->id }}">
                    <a href="#" class="btn btn-link like active-like">Like</a>
                    <a href="#" class="btn btn-link like">Dislike</a> 
                     <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-link">Comment</a>
                </div>
            </div>    
                        @endif
                    @endforeach
                </div>
                </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
