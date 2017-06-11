@extends('layouts.front')

@section('content')

<div class="container">
  <img class="welcome-logo" src="{{ asset('img/aeir.png') }}">

  <p class="welcome-desc">L’amicale a eu l’idée de créer ce site blabla.... [texte en cours de rédaction]</p>

  <div class="welcome-btn">
    <a class="btn btn-default" style="margin-right: 10px" href="{{ url('home') }}">Consulter les annonces</a>
    <a class="btn btn-default" href="{{ url('bids') }}">Gérer mes annonces</a>
  </div>
</div>

@endsection
