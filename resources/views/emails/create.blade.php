<?php $message->subject('Nouvelle annonce en attente de validation'); ?>

<h1>Nouvelle annonce en attente de validation</h1>

<p>
    Une annonce a été créée sur <a href="{{ url('/') }}">logements.insa-rennes.fr</a> et est en attente de validation.
</p>

<blockquote>
    <a href="{{ url('/bids/' . $bid->id) }}">{{ $bid->name }}</a>, par {{ $author }}
</blockquote>

<p>
    Cliquez sur ce <a href="{{ route('admin.bids.index') }}">lien</a> pour la modérer.
</p>
