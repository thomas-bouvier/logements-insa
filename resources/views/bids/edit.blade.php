@extends('layouts.front')

@section('content')

<div class="container">
  <h4>Éditer l'annonce « {{ $bid->name }} »</h4>

  @include('bids.form', ['action' => 'update'])
</div>

@endsection
