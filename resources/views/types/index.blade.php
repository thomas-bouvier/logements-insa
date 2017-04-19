@extends('layouts.front')

@section('content')

<div class="container">
  <h4>Gérer les catégories</h4>

  <p class="text-right">
    <a class="btn btn-primary" href="{{ action('TypeController@create') }}">Ajouter une catégorie</a>
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
          <a class="btn btn-primary" href="{{ action('TypeController@edit', $type) }}">Éditer</a>
          <a class="btn btn-primary" href="{{ action('TypeController@destroy', $type) }}">Supprimer</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
