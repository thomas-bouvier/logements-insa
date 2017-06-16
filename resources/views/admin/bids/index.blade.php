@extends('layouts.front')

@section('content')

<div class="container">
    <h4>Modérer les annonces</h4>

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
                    <a class="btn btn-danger" href="{{ action('BidController@destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?">Supprimer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
