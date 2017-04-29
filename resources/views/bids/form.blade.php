<div class="row">
  <div class="col-md-10 col-md-offset-1">
    {!! Form::model($bid, ['files' => true, 'class' => 'form-horizontal', 'url' => action("BidController@$action", $bid), 'method' => $action == "store" ? "Post" : "Put"]) !!}

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label">Titre</label>
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label">Type de bien</label>
            {!! Form::select('type_id', App\Type::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label">Quartier</label>
            {!! Form::text('district', null, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label">Surface (m<sup>2</sup>)</label>
            {!! Form::text('ground', null, ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label">Montant du loyer (€)</label>
            {!! Form::text('rental', null, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label">Adresse mail de contact</label>
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label">Photos</label>
        <div data-id="{{ $bid->id }}" class="dropzone dropzone-previews" id="my-dropzone"></div>
      </div>

      <!--
      <div class="form-group">
        <label class="control-label">Photos</label>
        {!! Form::file('photos[]', ['class' => 'form-control', 'multiple' => true]) !!}
        @if ($action == 'update')
          @for ($i = 1; $i <= $bid->photo_count; $i++)
            <img src="{{ $bid->photo('thumb', $i) }}" class="img-responsive" alt="{{ $bid->name }}">
          @endfor
        @endif
      </div>
      -->

      <div class="form-group">
        <label class="control-label">Description</label>
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">
          @if ($action == 'store')
            Envoyer
          @else
            Mettre à jour
          @endif
        </button>
      </div>

    {!! Form::close() !!}
  </div>
</div>
