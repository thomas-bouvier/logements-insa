@extends('layouts.front')

@section('content')

<div class="container">
  <h4>Ajouter une annonce</h4>

  @include('bids.form', ['action' => 'store'])
</div>

@endsection
