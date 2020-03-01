@extends('layouts.app')
@section('content')
<style media="screen">
    .card {

        margin: 0;
    }
</style>
<div class="container">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="card" style="margin:0; border-radius: 0;">
            <div class="card-header">
                <h3 class="card-title">{{ $post->title }}</h3>
                </div>
                <div class="card-body">
                    {{ $post->body }}
                    <br />
                    @if ($post->image != null)
                        <img src="/images/{{ $post->image }}" alt="Image" width="100%" height="600">
                    @endif
                    <div class="badge">
                    {{ $post->category->name }}   
                    </div>
                   
                </div>
                <div class="card-footer" data-postid="{{ $post->id }}">
                    @if(Auth::check())
                        @foreach(Auth::user()->likes as $like)
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
                    @else
                        <a href="{{ url('login') }}" class="btn btn-link">Like</a>
                        <a href="{{ url('login') }}" class="btn btn-link">Dislike</a>
                    @endif
                    <a href="#" class="btn btn-link">Comment</a>
                </div>
            </div>
            <div class="card" style="margin: 0;">
                <div class="card-body">
                    All Comments will be shown here
                </div>
            </div>
            <div class="card" style="margin: 0; border-radius: 0;">
                <div class="card-body" style="display: flex;">
                    <input type="text" name="Comment" placeholder="Comment..." class="form-control" style="border-radius: 0;">
                    <input type="submit" value="Comment" class="btn btn-primary" style="border-radius: 0;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

