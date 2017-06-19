<div class="container">
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
                    <label class="control-label">Catégorie</label>
                    {!! Form::select('type_id', App\Type::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Localisation</label>
                    {!! Form::text('location', null, ['class' => 'form-control']) !!}
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
            <div class="dz-message"></div>

            <div data-id="{{ $bid->id }}" class="dropzone dropzone-previews" id="my-dropzone"></div>
        </div>

        <div class="form-group">
            <label class="control-label">Description</label>
            {!! Form::textarea('description', null, ['class' => 'form-control', 'style' => 'resize: vertical']) !!}
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
