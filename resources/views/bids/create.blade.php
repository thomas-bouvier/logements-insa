@extends('layouts.front')

@section('head')

<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="container">
  <h4>Ajouter une annonce</h4>

  @include('bids.form', ['action' => 'store'])
</div>

@endsection

@section('js')

<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/custom_dropzone.js') }}"></script>

@endsection
