@extends('layouts.front')

@section('content')

<div class="container">
  <div class="pull-left">
    <h4>{{ $bid->name }}</h4>
  </div>

  <p class="pull-right">
  </p>

  <p class="text-center">
    <img src="{{ url($bid->image('large')) }}" alt="{{ $bid->name }}">
  </p>
</div>

@endsection
