@extends('layouts.front')

@section('content')

<div class="container">
  <img class="welcome-logo" src="{{ asset('img/aeir.png') }}">

  <p class="welcome-desc">Tu lâches ton appartement ? Une place se libère dans ta colocation ? Tu souhaites faire profiter de ce bon plan à un Insalien ? Tu cherches un appartement après avoir passé 2 ans en résidence ?</p>
  <p class="welcome-desc">L'amicale a pensé à toi et te propose donc  ce site de petites annonces. Tu pourras y poster ton annonce ou trouver les annonces postées par les insaliens...</p>

  <div class="welcome-btn">
    <a class="btn btn-default" style="margin-right: 10px" href="{{ url('home') }}">Consulter les annonces</a>
    <a class="btn btn-default" href="{{ url('bids') }}">Gérer mes annonces</a>
  </div>
</div>

@endsection
