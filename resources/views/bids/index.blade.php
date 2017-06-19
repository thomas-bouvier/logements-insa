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
                <th class="hidden-xs">Catégorie</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($bids as $bid)
            <tr>
                <td>{{ $bid->name }}</td>
                <td class="hidden-xs">{{ $bid->type->name }}</td>
                <td>
                    @if ($bid->isPending())
                        <span class="label label-info">En attente</span>
                    @elseif ($bid->isApproved())
                        <span class="label label-success">Validée</span>
                    @elseif ($bid->isRejected())
                        <span class="label label-danger">Rejetée</span>
                    @elseif ($bid->isPostponed())
                        <span class="label label-warning">Reportée</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary btn-responsive" href="{{ route('bids.show', $bid) }}"><i class="glyphicon glyphicon-eye-open"></i> Voir</a>

                    @if ($bid->isPostponed())
                        <a class="btn btn-default btn-responsive" href="{{ route('bids.edit', $bid) }}"><i class="glyphicon glyphicon-pencil"></i> Corriger</a>
                    @else
                        <a class="btn btn-default btn-responsive" href="{{ route('bids.edit', $bid) }}"><i class="glyphicon glyphicon-pencil"></i> Éditer</a>
                    @endif

                    <a class="btn btn-danger btn-responsive" href="{{ route('bids.destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
