@extends('layouts.front')

@section('content')

<div class="container">
  @foreach ($bids as $bid)
    @include ('bids.show')
  @endforeach
</div>

@endsection
