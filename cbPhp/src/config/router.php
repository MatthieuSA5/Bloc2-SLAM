<?php

use Acme\CompteBancaire;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', function () {
    return 'Hello World!';
});

SimpleRouter::get('/cb/{solde?}', function ($solde=0) {
    global $twig;
    $cb = new CompteBancaire("Toto", $solde);
    return $twig->render('cbView.html.twig', ['cb' => $cb]);
});

SimpleRouter::get('/op/{solde?}/{montant?}', function ($solde=0, $montant=0) {
    global $twig;
    $cb = new CompteBancaire("Toto", $solde);
    $cb->deposer("depot", $montant);
    return $twig->render('cbView.html.twig', ['cb' => $cb]);
});