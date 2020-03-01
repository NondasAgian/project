@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-6 col-sm-offset-3">
    @foreach ($posts as $post)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                       Created by {{ $post->user->username }}, {{$post->title }}
                       <div class="pull-right">
                           <a href="{{ route('post.show', [$post->id]) }}" class="btm btn-link">Show Post</a>
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
                @if ($like->post_id == $post->id)
                                @if($like->like )
                                    <a href="#" class="btn btn-link like active-like">Like</a>
                                    <a href="#" class="btn btn-link like">Dislike</a>
                                @else 
                                    <a href="#" class="btn btn-link like">Like</a>
                                    <a href="#" class="btn btn-link like active-like">Dislike</a> 
                                @endif
                            @else 
                                <a href="#" class="btn btn-link like">Like</a>
                                <a href="#" class="btn btn-link like">Dislike</a> 
                            @endif
                        @endforeach
                    <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-link">Comment</a>
                </div>
            </div>    
            @endforeach
    </div>
</div>
@endsection
