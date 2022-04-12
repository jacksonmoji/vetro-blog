@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3 ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Blog</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $blog->title }}"
                                placeholder="blog title">

                            @error('title')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control" name="body" rows="3"
                                placeholder="Blog something!"> {{ $blog->body }}</textarea>

                            @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
