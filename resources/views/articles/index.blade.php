@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert"">
        <button type="button" class="btn-close float-end" data-dismiss="alert" aria-label="Close">

          </button>

          {{ Session('info') }}
    </div>
    @endif
    {{ $articles->links() }}
    @foreach($articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <div class="card-subtitle text-muted small mb-2">
                {{ $article->created_at->diffForHumans() }}
            </div>
            <p class="card-text">{{ $article->body }}</p>
            <a href="{{ url("/articles/detail/$article->id") }}" class="card-link">
            View Detail &raquo
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection
