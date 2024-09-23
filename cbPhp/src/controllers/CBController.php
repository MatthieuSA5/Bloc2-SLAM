<?php

namespace App\controllers;

use Pecee\SimpleRouter\SimpleRouter;
use App\models\CompteBancaire;

class CBController extends BaseController
{
    private function getMenu() {
        if(isset($_SESSION['cb'])){
            return [
                ['caption'=>'Dépôt','route'=>'/depot'],
                ['caption'=>'Retrait','route'=>'/retrait'],
                ['caption'=>'Fermer le compte','route'=>'/fermer']
            ];
        }
        return [['caption' => 'Créer un compte', 'route' => '/newCompte']];
    }

    public function index(){
        $cb=$_SESSION['cb']??null;
        return $this->render('cbView.html.twig',['cb'=>$cb]);
    }

    public function newCompteForm(){
        return $this->render('newCompte.html.twig');
    }

    public function newCompte(){
        $titulaire=$_POST['titulaire'];
        $cb=new CompteBancaire($titulaire);
        $_SESSION['cb']=$cb;
        return $this->render('cbView.html.twig',['cb'=>$cb]);
    }

    public function fermer(){
        $_SESSION['cb']=null;
        unset($_SESSION['cb']);
        \session_destroy();
        return SimpleRouter::response()->redirect('/');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////

    public function retrait($montant) {
        if ($montant > $this->solde) {
            return "Fonds insuffisants pour le retrait.";
        }$this->solde -= $montant;
        return "Retrait de $montant effectué. Nouveau solde: " . $this->solde;
    }

    public function depot($montant) {
        if ($montant <= 0) {
            return "Le montant du dépôt doit être positif.";
        }$this->solde += $montant;
        return "Dépôt de $montant effectué. Nouveau solde: " . $this->solde;
    }

    public function getSolde() {
        return $this->solde;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

    public function render(string $view, array $parameters = []){
        $parameters['menu']=$this->getMenu();
        return parent::render($view, $parameters);
    }
}