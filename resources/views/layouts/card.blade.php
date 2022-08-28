@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @yield('card-outter')
        <div class="row">
          <div class="col">

            <div class="card">
              <div class="card-header">@yield('page-title')</div>

              <div class="card-body ">
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif

                @yield('card-content')
              </div>

            </div>
          </div>
          @yield('card-outter-below')
        </div>
      </div>
    </div>
  </div>
@endsection
