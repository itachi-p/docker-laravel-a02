@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">

        @csrf

        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="form-label text-secondary">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter title here" class="form-control" autofocus>
            {{-- error --}}
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        {{-- body --}}
        <div class="mb-3">
            <label for="body" class="form-label text-secondary">Body</label>
            <textarea name="body" id="body" rows="5" class="form-control" placeholder="Start writing...">{{ old('body') }}</textarea>
            {{-- error --}}
            @error('body')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        {{-- image --}}
        <div class="mb-3">
            <label for="image" class="form-label text-secondary">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <div class="form-text">
                Acceptable formats are: jpeg, jpg, png, gif only<br>
                Maximum file size is 1048kb.
            </div>
            {{-- error --}}
            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-5">Post</button>
    </form>
@endsection