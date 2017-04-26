@extends('layouts.front')

@section('content')

<div class="container">
  <div class="pull-left">
    <h4>{{ $bid->name }}</h4>
  </div>

  <p class="pull-right">
    @if (cas()->user() == $bid->user_id)
      <a class="btn btn-default" href="{{ action('BidController@edit', $bid) }}">Éditer</a>
      <a class="btn btn-danger" href="{{ action('BidController@destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?">Supprimer</a>
    @else
      <a class="btn btn-primary" href="mailto:{{ $bid->email }}">Contacter l'annonceur</a>
    @endif
  </p>

  <div class="clearfix"></div>

  <p class="text-center">
    <img src="{{ url($bid->image('large')) }}" alt="{{ $bid->name }}">
  </p>

  <h5 class="bid-description-title">Description</h5>

  <p class="bid-description">
    {{ $bid->description }}
  </p>

  <h5 class="bid-details-title">Caractéristiques</h5>

  <p class="bid-details">
    <ul>
      <li>
        <p>Type de bien : {{ $bid->type->name }}</p>
      </li>

      <li>
        <p>Montant du loyer : {{ $bid->rental }} €</p>
      </li>

      <li>
        <p>Surface : environ {{ $bid->ground }} m<sup>2</sup></p>
      </li>

      <li>
        <p>Localisation : {{ $bid->district }}</p>
      </li>
    </div>
  </p>
</div>

@endsection
