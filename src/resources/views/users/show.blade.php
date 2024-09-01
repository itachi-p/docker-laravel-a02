@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="row mt-2 mb-5">
        <div class="col-4">
            @if ($user->avatar)
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail w-100">
            @else
                <i class="fa-solid fa-image fa-10x text-center"></i>
            @endif
        </div>

        <div class="col-8">
            <h2 class="display-6">{{ $user->name }}</h2>

            {{--TODO: I want to specify a user_id that clearly identifies the poster of the post, not by the "$user->posts()->first()->user_id". --}}
            {{-- {{ print_r($user->posts()->first()->user_id . "*") }} --}}
            @if ($user->posts()->first()->user_id === Auth::user()->id)
                <a href="{{ route('profile.edit', Auth::user()->id) }}" class="text-decoration-none">Edit Profile</a>
            @endif
        </div>
    </div>

    {{-- show all posts --}}
    {{-- user has many posts --}}
    @if ($user->posts)
        <ul class="list-group mb-5">
            @foreach ($user->posts as $post)
                <li class="list-group-item py-4">
                    <a href="{{ route('post.show', $post->id) }}">
                        <h3 class="h4">{{ $post->title }}</h3>
                    </a>
                    <p class="fw-light mb-0">{{ $post->body }}</p>
                    {{-- image --}}
                    <img src="{{ $post->image }}" alt="{{ $post->title}}" class="w-25 shadow rounded">

                </li>
            @endforeach
        </ul>
    @endif
@endsection