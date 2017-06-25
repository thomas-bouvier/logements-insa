<div class="container">
    {!! Form::model($bid, ['files' => true, 'class' => 'form-horizontal', 'url' => action("BidController@$action", $bid), 'method' => $action == "store" ? "Post" : "Put"]) !!}

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Titre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('name')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('type_id')) has-error @endif">
                    {!! Form::label('type_id', 'Catégorie') !!}
                    {!! Form::select('type_id', App\Type::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                    @if ($errors->has('type_id')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('type_id') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('location')) has-error @endif">
                    {!! Form::label('location', 'Localisation') !!}
                    {!! Form::text('location', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('location')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('location') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('ground')) has-error @endif">
                    {!! Form::label('ground', 'Surface (mètres carrés)') !!}
                    {!! Form::text('ground', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('ground')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('ground') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('rental')) has-error @endif">
                    {!! Form::label('rental', 'Montant du loyer (€)') !!}
                    {!! Form::text('rental', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('rental')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('rental') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Adresse mail de contact') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('email')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group @if ($errors->has('file')) has-error @endif">
            {!! Form::label('file', 'Photos') !!}
            <div data-id="{{ $bid->id }}" class="dropzone dropzone-previews" id="my-dropzone"></div>
            @if ($errors->has('file')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                {{ $errors->first('file') }}</p>
            @endif
        </div>

        <div class="form-group @if ($errors->has('description')) has-error @endif">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'style' => 'resize: vertical']) !!}
            @if ($errors->has('description')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                {{ $errors->first('description') }}</p>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                @if ($bid->name == null)
                    Envoyer
                @else
                    Mettre à jour
                @endif
            </button>
        </div>

    {!! Form::close() !!}
</div>
