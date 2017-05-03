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

      <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-9">
          <img src="{{ $bid->photo('large', 1) }}" class="img-responsive" alt="{{ $bid->name }}">
        </div>

        <div class="col-md-3">
          <h5 class="bid-details-title">Caractéristiques</h5>
          <p class="bid-details">
            <ul>
              <li>
                Type de bien : {{ $bid->type->name }}
              </li>

              <li>
                Montant du loyer : {{ $bid->rental }} €
              </li>

              <li>
                Surface : environ {{ $bid->ground }} m<sup>2</sup>
              </li>

              <li>
                Localisation : {{ $bid->district }}
              </li>
            </ul>
          </div>
        </p>
      </div>

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
