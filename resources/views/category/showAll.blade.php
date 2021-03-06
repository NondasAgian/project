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
                    <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-link">Comment</a>
                </div>
            </div>    
    </div>
</div>
@endsection
