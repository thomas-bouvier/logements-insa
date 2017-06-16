@extends('layouts.front')

@section('content')

<div class="container">
    <div class="pull-left">
        <h4>Gérer mes annonces</h4>
    </div>

    <p class="pull-right">
        <a class="btn btn-primary" href="{{ route('bids.create') }}">Ajouter une annonce</a>
    </p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type de bien</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($bids as $bid)
            <tr>
                <td>{{ $bid->name }}</td>
                <td>{{ $bid->type->name }}</td>
                <td>
                    @if ($bid->isPending())
                        <span class="label label-info">En attente de modération</span>
                    @elseif ($bid->isApproved())
                        <span class="label label-success">Modérée, validée</span>
                    @elseif ($bid->isRejected())
                        <span class="label label-danger">Modérée, rejetée</span>
                    @elseif ($bid->isPostponed())
                        <span class="label label-warning">Modérée, mise en attente</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('bids.show', $bid) }}">Voir</a>

                    @if ($bid->isPostponed())
                        <a class="btn btn-default" href="{{ route('bids.edit', $bid) }}">Corriger</a>
                    @else
                        <a class="btn btn-default" href="{{ route('bids.edit', $bid) }}">Éditer</a>
                    @endif

                    <a class="btn btn-danger" href="{{ route('bids.destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?">Supprimer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
