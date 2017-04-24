@extends('layouts.front')

@section('content')

<div class="container">
  <div class="pull-left">
    <h4>Gérer mes annonces</h4>
  </div>

  <p class="pull-right">
    <a class="btn btn-primary" href="{{ action('BidController@create') }}">Ajouter une annonce</a>
  </p>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Montant du loyer (€)</th>
        <th>Type de bien</th>
        <th>Surface (m<sup>2</sup>)</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      @foreach($bids as $bid)
      <tr>
        <td>{{ $bid->name }}</td>
        <td>{{ $bid->rental }}</td>
        <td>{{ $bid->type->name }}</td>
        <td>{{ $bid->ground }}</td>
        <td>
          <a class="btn btn-primary" href="{{ action('BidController@show', $bid) }}">Voir</a>
          <a class="btn btn-default" href="{{ action('BidController@edit', $bid) }}">Éditer</a>
          <a class="btn btn-default" href="{{ action('BidController@destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment clotûrer l'annonce « {{ $bid->name }} » ?">Clôturer</a>
          <a class="btn btn-danger" href="{{ action('BidController@destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?">Supprimer</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
