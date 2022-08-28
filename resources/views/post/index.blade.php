@extends('layouts.card')

@section('page-title')
  Posts
@endsection

@section('card-outter')
  <div class="container d-flex justify-content-end p-2">
    <a class="btn btn-primary m-2" href="{{ route('posts.create') }}" role="button">Create New Post</a>
    <a class="btn btn-secondary m-2" href="{{ route('categories.create') }}" role="button">Add New Category</a>
  </div>
@endsection

@section('card-content')
  <div id='post-container'>
    @foreach ($posts as $post)
      <div class="row justify-content-center mb-4">
        <div class="col">

          <div class="fw-bold">
            <h2>{{ $post->title }}</h2>
            <h3 class="{{ 'post' . $post->category->id }} badge bg-secondary">{{ $post->category->name }}</h3>
          </div>

          @isset($post->image)
            <img class="img-thumbnail img-fluid" width="200" src="{{ url("images\\$post->image") }}"
              alt="{{ $post->title }}">
            <br>
          @endisset

          {{ \Illuminate\Support\Str::limit($post->content, 80, '...') }}

          <a class="btn btn-link btn-sm float-end" href="{{ route('posts.show', ['post' => $post]) }}">
            Read More
          </a>
        </div>
        <hr>
      </div>
    @endforeach
    <p class="text-muted text-center">Created by <a href="https://www.github.com/ramdhanyA">Ariq Ramdhany</a>
    </p>
  </div>
@endsection

@section('card-outter-below')
  <div class="form-check col-md-2">
    @foreach ($categories as $category)
      <div class="cat-checkbox">
        <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="{{ 'cat' . $category->id }}">
        <label class="form-check-label" for="flexCheckDefault">
          {{ $category->name }}
        </label>
      </div>
    @endforeach
  </div>
@endsection


@section('scripts')
  <script src="{{ asset('js/filter.js') }}"></script>
@endsection

{{-- - Implement category check box
  - Implement category color code --}}
