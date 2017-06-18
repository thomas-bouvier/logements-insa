<?php $message->subject('Votre annonce est en ligne'); ?>

<h1>Votre annonce est en ligne</h1>

<p>
    Vous avez récemment créé une annonce sur <a href="{{ url('/') }}">logements.insa-rennes.fr</a>. Celle-ci a été validée et est désormais en ligne.</p>
</p>

<p>
    Cliquez sur ce <a href="{{ url('/bids/' . $bid->id) }}">lien</a> pour la visualiser.
</p>
