@extends('layouts.front')

@section('content')

<div class="container">
  <h4>Éditer le type de bien « {{ $type->name }} »</h4>

  @include('types.form', ['action' => 'update'])
</div>

@endsection
