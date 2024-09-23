<?php
use Pecee\SimpleRouter\SimpleRouter;
use App\models\CompteBancaire;

simpleRouter::group(['namespace'=>'App\controllers'],function(){
    SimpleRouter::get('/', 'CBController@index');
    SimpleRouter::get('/newCompte', 'CBController@newCompteForm');
    SimpleRouter::post('/newCompte','CBController@newCompte');
    SimpleRouter::get('/fermer', 'CBController@fermer');
    SimpleRouter::get('/users', 'CBController@users');
    SimpleRouter::get('/retrait', 'CBController@retrait');
    SimpleRouter::get('/depot', 'CBController@depot');
});