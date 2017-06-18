<?php $message->subject('Votre annonce doit être corrigée'); ?>

<h1>Votre annonce doit être corrigée</h1>

<p>
    Vous avez récemment créé une annonce sur <a href="{{ url('/') }}">logements.insa-rennes.fr</a>. Celle-ci nécessite d'être corrigée avant d'être à nouveau modérée.</p>
</p>

<p>
    Cliquez sur ce <a href="{{ url('/bids/' . $bid->id . '/edit') }}">lien</a> pour la corriger.
</p>
