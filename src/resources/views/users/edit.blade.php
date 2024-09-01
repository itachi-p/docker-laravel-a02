@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <form action="{{ route('profile.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- image --}}
        <div class="row mt-2 mb-3">
            <div class="col-4">
                @if ($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail w-100">
                @else
                    <i class="fa-solid fa-image fa-10x d-block text-center"></i>
                @endif

                <input type="file" name="avatar" class="form-control mt-1">
                <div class="form-text">
                    Acceptable formats: jpeg, jpg, png, gif only<br>
                    Maximum file size: 1048kb
                </div>
                {{-- Error --}}
                @error('avatar')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- name --}}
        <div class="mb-3">
            <label for="name" class="form-label text-muted">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control">
            {{-- Error --}}
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
        {{-- email --}}
        <div class="mb-3">
            <label for="name" class="form-label text-muted">Name</label>
            <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
            {{-- Error --}}
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning px-5">Save</button>
    </form>
@endsection