@extends('layouts.card')

@section('page-title')
  Edit '{{ $post->title }}'
@endsection

@section('card-content')
  <form method="POST" action={{ route('posts.update', ['post' => $post]) }} enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
        <input id="title" type="title" class="form-control" name="title" value="{{ $post->title }}" required
          autocomplete="title" autofocus>
      </div>
    </div>


    <div class="row mb-3">
      <label for="content" class="col-md-2 col-form-label">{{ __('Content') }}</label>
      <div class="col-md-10">
        <textarea id="content" type="content" class="form-control" name="content" rows="8" required>{{ $post->content }}</textarea>
      </div>
    </div>


    <div class="row mb-3">
      @if (isset($post->image))
        <label for="image" class="col-md-2 col-form-label">{{ __('Current Image') }}</label>
        <img id='current-image' src="{{ url("images\\$post->image") }} " class="col-md-2" width="20">
        <button type="button" class="col d-block btn btn-link" onclick="removeImage()">Remove Image</button>
        <div class="col m-auto">
          <input id="keep-image" type="checkbox" name="keep-image" value="keep-image" onchange="keepImage()" checked>
          <label for="keep-image">Keep Current Image</label>
        </div>
      @endif
    </div>

    <div class="row mb-3" id="new-image">
      <label for="image" class="col-md-2 col-form-label">{{ __('New Image') }}</label>

      <div class="col-md-10">
        <input id="image" type="file" class="form-control" name="image" autocomplete="image" autofocus>
      </div>
    </div>


    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">
        {{ __('Update') }}
      </button>
    </div>
  </form>
@endsection

@section('scripts')
  <script>
    $(document).ready(() => {
      $('#new-image').hide();
    });

    function removeImage() {
      {{ $post->image = null }}
      console.log($('current-image'));
      $('#current-image').remove();
    }

    function keepImage() {
      if ($('#keep-image').is(':checked')) {
        console.log('keepImage');
        $('#new-image').hide();
      } else {
        $('#new-image').show();
      }
    }
  </script>
@endsection
