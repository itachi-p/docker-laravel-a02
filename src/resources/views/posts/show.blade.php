@extends('layouts.app')

@section('title', 'Show Post')


@section('content')
    <div class="mt-2 border border-2 rounded p-4 shadow-sm">
        {{-- title --}}
        <h2 class="h4">{{ $post->title }}</h2>

        {{-- owner --}}
        <h3 class="h6 text-muted">{{ $post->user->name }}</h3>

        {{-- body --}}
        <p>{{ $post->body }}</p>

        {{-- image --}}
        <img src="{{ $post->image }}" alt="{{ $post->title}}" class="w-100 shadow rounded">
    </div>

    {{-- comment form --}}
    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf
        <div class="input-group mt-5">
            <input type="text" name="comment" id="comment" placeholder="Add a comment..." value="{{ old('comment') }}" class="form-control">
            <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
        </div>
        {{-- error --}}
        @error('comment')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </form>

    {{-- show all comments here --}}
    @if ($post->comments)
        <div class="mt-2 mb-5">
            @foreach ($post->comments as $comment)
                <div class="row p-2">
                    <div class="col-10">
                        <span class="fw-bold">{{ $comment->user->name }}</span>&nbsp;
                        <span class="small text-muted">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>
                        <p class="mb-0">{{ $comment->body }}</p>
                    </div>
                    <div class="col-2 text-end">
                        {{-- Show delete button if Auth user is the owner of the comment --}}
                        @if ($comment->user_id === Auth::user()->id) {{-- or comment->user->id is also OK --}}
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection