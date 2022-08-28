@extends('layouts.card')

@section('page-title')
  Create a New Post
@endsection

@section('card-content')
  <form method="POST" action={{ route('posts.store') }} enctype="multipart/form-data">
    @csrf
    <div class="d-flex justify-content-end mb-2">
      <select name="category_id" id="category" type="category" class="form-select-sm" aria-label="Default select example">
        @foreach ($categories as $category)
          <option class="dropdown-item" value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>


    <div class="row mb-3">
      <label for="title" class="col-md-2 col-form-label">{{ __('Title') }}</label>

      <div class="col-md-10">
        <input id="title" type="title" class="form-control" name="title" value="{{ old('title') }}" required
          autocomplete="title" autofocus>
      </div>
    </div>


    <div class="row mb-3">
      <label for="content" class="col-md-2 col-form-label">{{ __('Content') }}</label>
      <div class="col-md-10">
        <textarea id="content" type="content" class="form-control" name="content" rows="8" required>{{ old('content') }}</textarea>
      </div>
    </div>


    <div class="row mb-3">
      <label for="image" class="col-md-2 col-form-label">{{ __('Post Image') }}</label>

      <div class="col-md-10">
        <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}"
          autocomplete="image" autofocus>
      </div>
    </div>


    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">
        {{ __('Create') }}
      </button>
    </div>
  </form>
@endsection
