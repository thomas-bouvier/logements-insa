@extends('layouts.front')

@section('content')

<div class="container">
  <h4>Éditer la catégorie « {{ $type->name }} »</h4>

  @include('admin.types.form', ['action' => 'update'])
</div>

@endsection
