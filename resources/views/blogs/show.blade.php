@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card ">
        <div class="card-header">
            <h2>{{ $blog->title }} </h2>
            @if($blog->ratings)
                @for($i = 0; $i < $blog->ratings->avg('rating'); $i++)
                <i class="bi bi-star-fill"></i>
                @endfor
            @endif
            <p class="lead">
                by {{ $blog->user->name }}
            </p>
            <span class="text-muted">
                {{ $blog->created_at->diffForHumans() }}
            </span>
            <form action="{{ route('ratings', $blog) }}" method="POST">
                @csrf
                <select class="form-select" aria-label="Blog rating" name="rating" onchange="this.form.submit();">
                    <option selected>Select your rating for this Blog</option>
                    <option value="1">One Star</option>
                    <option value="2">Two Stars</option>
                    <option value="3">Three Stars</option>
                    <option value="4">Four Stars</option>
                    <option value="5">Five Stars</option>
                </select>
            </form>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $blog->body }}</p>
        </div>
    </div>
</div>
@endsection
