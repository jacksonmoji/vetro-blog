@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row row-cols-5 gap-2 p-3">
        @if ($blogs->count())
        @foreach ($blogs as $blog)
        <div class="card" style="width: 25rem;">
            <div class=" card-body">
                <h5 class="card-title">{{ $blog->title }} </h5>
                <h6 class="card-subtitle mb-2 text-muted"> {{ $blog->user->name}} </h6>
                <small class="text-muted">{{ $blog->created_at->diffForHumans() }} 
                    <span>
                        @if($blog->ratings)
                            @for($i = 0; $i < $blog->ratings->avg('rating'); $i++)
                            <i class="bi bi-star-fill"></i>
                            @endfor
                        @endif
                    </span>
                </small>

                <p class="card-text">{{substr($blog->body, 0, 40)}}...</p>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                        @auth
                            @if(Auth::user()->id == $blog->user_id)

                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                            </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p>There are no blogs</p>
        @endif
    </div>
</div>

@endsection
