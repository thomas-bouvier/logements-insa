<div class="container">
    {!! Form::model($type, ['class' => 'form-horizontal', 'url' => route("admin.types.$action", $type), 'method' => $action == "store" ? "Post" : "Put"]) !!}

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Nom') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('name')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group @if ($errors->has('slug')) has-error @endif">
                    {!! Form::label('slug', 'Slug (facultatif)') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('slug')) <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        {{ $errors->first('slug') }}</p>
                    @endif
                </div>
            </div>
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
