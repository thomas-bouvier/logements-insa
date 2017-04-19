@extends('layouts.front')

@section('content')

<div class="container">
  <h4>Ajouter une catégorie</h4>

  @include('types.form', ['action' => 'store'])
</div>

@endsection
