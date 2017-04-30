@extends('layouts.front')

@section('content')

<div class="container">
  <div class="bid-title">
    <div class="pull-left">
      @if (App\User::where('login', cas()->user())->first()->id == $bid->user_id)
        <h4>{{ $bid->name }}</h4>
      @else
        <h4>{{ $bid->name }} <small>par {{ App\User::where('id', $bid->user_id)->first()->login }}</small></h4>
      @endif
    </div>

    <p class="pull-right">
      @if (App\User::where('login', cas()->user())->first()->id == $bid->user_id)
        <a class="btn btn-default" href="{{ action('BidController@edit', $bid) }}">Éditer</a>
        <a class="btn btn-danger" href="{{ action('BidController@destroy', $bid) }}" data-method="delete" data-confirm="Voulez-vous vraiment supprimer l'annonce « {{ $bid->name }} » ?">Supprimer</a>
      @else
        <a class="btn btn-primary" href="mailto:{{ $bid->email }}">Contacter l'annonceur</a>
      @endif
    </p>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-9">
      <div id="lightgallery">
          @for ($i = 1; $i <= $bid->photo_count; $i++)
              <a href="{{ $bid->photo('original', $i) }}">
                <img src="{{ $bid->photo('thumb', $i) }}" class="img-responsive" alt="{{ $bid->name }}">
              </a>
          @endfor
      </div>
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

  <h5 class="bid-description-title">Description</h5>

  <p class="bid-description">
    {!! nl2br($bid->description); !!}
  </p>
</div>

@endsection
