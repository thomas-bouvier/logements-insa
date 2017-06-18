@extends('layouts.front')

@section('content')

<div class="container">
    <h4>Modérer les annonces</h4>

    <h5 style="margin-top: 35px">Annonces en attente de modération</h5>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Nom</th>
                <th>Actions</th>
                <th>Modération</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pending_bids as $pending_bid)
            <tr>
                <td>{{ App\User::where('id', $pending_bid->user_id)->first()->login }} <a class="btn btn-default" href="mailto:{{ App\User::where('id', $pending_bid->user_id)->first()->login }}@insa-rennes.fr">Contacter</a></td>
                <td>{{ $pending_bid->name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('bids.show', $pending_bid) }}">Voir</a>
                    <a class="btn btn-default" href="{{ route('bids.edit', $pending_bid) }}">Éditer</a>
                    <a class="btn btn-danger" href="{{ route('bids.destroy', $pending_bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $pending_bid->name }} » ?">Supprimer</a>
                </td>
                <td>
                    <a class="btn btn-success" href="{{ action('Admin\\BidController@approve', $pending_bid) }}">Approuver</a>
                    <a class="btn btn-warning" href="{{ action('Admin\\BidController@postpone', $pending_bid) }}">Mettre en attente</a>
                    <a class="btn btn-danger" href="{{ action('Admin\\BidController@reject', $pending_bid) }}" data-confirm="Voulez-vous vraiment rejeter l'annonce « {{ $pending_bid->name }} » ? Celle-ci sera définitivement supprimée !">Rejeter</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 style="margin-top: 35px">Annonces mises en attente</h5>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($postponed_bids as $postponed_bid)
            <tr>
                <td>{{ App\User::where('id', $postponed_bid->user_id)->first()->login }} <a class="btn btn-default" href="mailto:{{ App\User::where('id', $postponed_bid->user_id)->first()->login }}@insa-rennes.fr">Contacter</a></td>
                <td>{{ $postponed_bid->name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('bids.show', $postponed_bid) }}">Voir</a>
                    <a class="btn btn-default" href="{{ route('bids.edit', $postponed_bid) }}">Éditer</a>
                    <a class="btn btn-danger" href="{{ route('bids.destroy', $postponed_bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $postponed_bid->name }} » ?">Supprimer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 style="margin-top: 35px">Annonces approuvées</h5>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($approved_bids as $approved_bid)
            <tr>
                <td>{{ App\User::where('id', $approved_bid->user_id)->first()->login }} <a class="btn btn-default" href="mailto:{{ App\User::where('id', $approved_bid->user_id)->first()->login }}@insa-rennes.fr">Contacter</a></td>
                <td>{{ $approved_bid->name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('bids.show', $approved_bid) }}">Voir</a>
                    <a class="btn btn-default" href="{{ route('bids.edit', $approved_bid) }}">Éditer</a>
                    <a class="btn btn-danger" href="{{ route('bids.destroy', $approved_bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $approved_bid->name }} » ?">Supprimer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
