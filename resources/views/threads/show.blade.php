@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $thread->body }}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            @foreach($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
        </div>

        @if(auth()->check())
        <div class="col-md-8">
            <form method="POST" action="{{ $thread->path() . '/replies' }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say" rows="5"></textarea>
                    <button type="submit" class="btn btn-default">Post</button>
                </div>
            </form>
        </div>
        @else
        <div class="col-md-8">
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
        </div>
        @endif
    </div>
</div>
@endsection
