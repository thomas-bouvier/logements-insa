{!! Form::model($bid, ['class' => 'form-horizontal', 'url' => action("BidController@$action", $bid), 'method' => $action == "store" ? "Post" : "Put"]) !!}

  <div class="form-group">
    <label class="control-label">Nom</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    <label class="control-label">Montant du loyer (€)</label>
    {!! Form::text('rental', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    <label class="control-label">Type de bien</label>
    {!! Form::select('type_id', App\Type::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    <label class="control-label">Quartier</label>
    {!! Form::text('district', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    <label class="control-label">Surface (m<sup>2</sup>)</label>
    {!! Form::text('ground', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    <label class="control-label">Description</label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary">
      Sauvegarder
    </button>
  </div>

{!! Form::close() !!}
