@extends('layouts.card')

@section('page-title')
  Categories
@endsection

@section('card-content')
  <form method="POST" action={{ route('categories.store') }} enctype="multipart/form-data">
    @csrf
    <div class="mb-2">
      <ul class="list-group">
        @foreach ($categories as $category)
          <li class="list-group-item">{{ $category->name }}</li>
        @endforeach
      </ul>
    </div>



    <input id="name" type="name" class="form-control mb-2" name="name" value="{{ old('name') }}" required
      autocomplete="name" autofocus>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">
        {{ __('Add New') }}
      </button>
    </div>
  </form>
@endsection
