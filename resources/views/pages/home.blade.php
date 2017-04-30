@extends('layouts.front')

@section('content')

<div class="container">
  @foreach ($bids as $bid)
    <article class="bid">
      <div class="bid-title">
        @if (App\User::where('login', cas()->user())->first()->id == $bid->user_id)
          <h4>{{ $bid->name }}</h4>
        @else
          <h4>{{ $bid->name }} <small>par {{ App\User::where('id', $bid->user_id)->first()->login }}</small></h4>
        @endif
      </div>

      <p class="text-center">
        <img src="{{ $bid->photo('thumb', 1) }}" class="img-responsive" alt="{{ $bid->name }}">
      </p>

      <a class="btn btn-primary" href="{{ action('BidController@show', $bid) }}">Voir</a>
      @if (App\User::where('login', cas()->user())->first()->id == $bid->user_id)
        <a class="btn btn-default" href="{{ action('BidController@edit', $bid) }}">Éditer</a>
        <a class="btn btn-danger" href="{{ action('BidController@destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?">Supprimer</a>
      @endif
    </article>
  @endforeach

  <div class="pagination">
    {{ $bids->render() }}
  </div>
</div>

@endsection
