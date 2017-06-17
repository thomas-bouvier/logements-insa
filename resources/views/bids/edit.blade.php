@extends('layouts.front')

@section('head')

<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

@endsection

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

@section('js')

<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/custom_dropzone.js') }}"></script>

@endsection
