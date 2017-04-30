@extends('layouts.front')

@section('content')

<div class="container">
  @if ($bid->name == null)
    <h4>Ajouter une annonce</h4>
  @else
    <h4>Éditer l'annonce « {{ $bid->name }} »</h4>
  @endif

  @include('bids.form', ['action' => 'update'])
</div>

@endsection
