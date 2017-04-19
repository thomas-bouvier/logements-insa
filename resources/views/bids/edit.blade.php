@extends('layouts.front')

@section('content')

<div class="container">
  <h4>Éditer la catégorie « {{ $type->name }} »</h4>

  @include('types.form', ['action' => 'update'])
</div>

@endsection
