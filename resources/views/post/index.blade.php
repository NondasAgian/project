@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-sm-9">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <a href ="#" class="close" data-dismiss="alert">&times;</a>
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                        @if ($errors->has('title'))
                            <small class="text-danger">{{ $errors->first('title') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                        <textarea name="body" rows="8" cols="80" class="form-control" placeholder="Text"></textarea>
                        @if ($errors->has('body'))
                            <small class="text-danger">{{ $errors->first('body') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach    
                        </select>    
                    </div>
                    <input type="submit" value="Post" class="btn btn-primary btn-block">
                </div>
            </div>
        </form>
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                       Created by {{ $post->user->username }}, {{$post->title }}
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
                    @php
                             $i= Auth::user()->likes->count();
                             $c = 1;
                    @endphp
                    @foreach(Auth::user()->likes as $like)
                        @if ($like->post_id == $post->id)
                            @if($like->like )
                               <a href="#" class="btn btn-link like active-like">Like</a>
                               <a href="#" class="btn btn-link like">Dislike</a>
                            @else 
                               <a href="#" class="btn btn-link like">Like</a>
                               <a href="#" class="btn btn-link like active-like">Dislike</a> 
                            @endif
                            @break
                        @elseif ($i == $c)
                               <a href="#" class="btn btn-link like">Like</a>
                               <a href="#" class="btn btn-link like">Dislike</a> 
                        @endif
                        @php
                            $c++;
                        @endphp
                    @endforeach
                    <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-link">Comment</a>
                </div>
            </div>    
            @endforeach
    </div>  
    <div class="nav">
        @foreach ($categories as $category)
        <a href="{{ route('category.showAll', [$category->name]) }}" class="nav-pills">{{ $category->name }}</a>
        @endforeach
    </div>
</div>
@endsection
