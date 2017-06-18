@extends('layouts.front')

@section('content')

<div class="container">
  <div class="pull-left">
    <h4>Gérer les catégories</h4>
  </div>

  <p class="pull-right">
    <a class="btn btn-primary" href="{{ route('admin.types.create') }}">Ajouter une catégorie</a>
  </p>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Slug</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      @foreach($types as $type)
      <tr>
        <td>{{ $type->id }}</td>
        <td>{{ $type->name }}</td>
        <td>{{ $type->slug }}</td>
        <td>
          <a class="btn btn-default" href="{{ route('admin.types.edit', $type) }}">Éditer</a>
          <a class="btn btn-danger" href="{{ route('admin.types.destroy', $type) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer la catégorie « {{ $type->name }} » ? Toutes les annonces de cette catégorie seront également supprimées !">Supprimer</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
