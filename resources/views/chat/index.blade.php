@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="column is-8 is-offset-2">
            <div class="card">
                <div class="card-header">
                    List of all Friends
                </div>
                @forelse ($friends as $friend)
                    <a href="{{ route('chat.show', $friend->id) }}" class="card">
                        {{ $friend->username }}
                    </a>
                @empty
                    <div class="card">
                        You don't have any friends :(
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection