<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\models\CompteBancaire;

SimpleRouter::get('/',function() {
    return 'Hello world';
});

SimpleRouter::get('/cb/{solde?}',function($solde=0) {
    global $twig;
    $cb=new CompteBancaire("Toto",$solde);
    return $twig->render('cbView.html.twig',['cb'=>$cb]);
});