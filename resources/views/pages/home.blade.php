@extends('layouts.front')

@section('content')

<div class="container">
  @foreach ($bids as $bid)
    <div class="pull-left">
      <h4>{{ $bid->name }}</h4>
    </div>

    <p class="pull-right">
      @if (cas()->user() == $bid->user_id)
        <a class="btn btn-default" href="{{ action('BidController@edit', $bid) }}">Éditer</a>
        <a class="btn btn-danger" href="{{ action('BidController@destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?">Supprimer</a>
      @endif
    </p>

    <p class="text-center">
      <img src="{{ url($bid->image('large')) }}" alt="{{ $bid->name }}">
    </p>
  @endforeach

  <div class="pagination">
    {{ $bids->render() }}
  </div>
</div>

@endsection
