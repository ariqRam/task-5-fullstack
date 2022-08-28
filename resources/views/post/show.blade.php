@extends('layouts.card')

@section('page-title')
  Post
@endsection

@section('card-content')
  <div>
    <div class="d-flex justify-content-between">
      <h2><strong>{{ $post->title }} </strong></h2>
      <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
        @method('Delete')
        @csrf
        <a class="mx-2" href="{{ route('posts.edit', ['post' => $post]) }}">Edit</a>
        <button class="btn btn-sm btn-danger d-inline">Delete</button>
      </form>
    </div>

    <span>Tags: </span>
    <h3 class="badge bg-secondary">{{ $post->category->name }}</h3>

    @isset($post->image)
      <br>
      <img class="img-fluid" src="{{ url("images\\$post->image") }}" alt="{{ $post->title }} ">
    @endisset

    <p>{{ $post->content }}</p>

  </div>
@endsection
