@extends('layouts.app')

@section('title', 'Edit Post')


@section('content')
    <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="form-label text-secondary">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" placeholder="Enter title here" class="form-control" autofocus>
            {{-- error --}}
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror

        </div>

        {{-- body --}}
        <div class="mb-3">
            <label for="body" class="form-label text-secondary">Body</label>
            <textarea name="body" id="body" rows="5" class="form-control" placeholder="Start writing...">{{ old('body', $post->body) }}</textarea>
            {{-- error --}}
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror

        </div>

        {{-- image --}}
        <div class="row mb-3">
            <div class="col-6">
                <label for="image" class="from-label text-secondary">Image</label>
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-100 img-thumbnail">
                <input type="file" name="image" id="image" class="form-control mt-1">
                <div class="form-text">
                    Acceptable formats are: jpeg, jpg, png, gif only<br>
                    Maximum file size is 1048kb.
                </div>
                {{-- error --}}
                @error('image')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-warning px-5">Save</button>
    </form>
    @endsection