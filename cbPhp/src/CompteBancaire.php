<?php

namespace Acme;

use mysql_xdevapi\Exception;
use function Sodium\add;

class CompteBancaire
{
    private string $titulaire;
    private float $solde=80;
    private array $operations;

    public function __construct(string $titulaire, float $solde=0){
        $this->titulaire = $titulaire;
        $this->solde = ($solde<0)?0:$solde;
        $this->operations = [];
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function getSolde():float{
        return $this->solde;
    }

    public function getTitulaire():string{
        return $this->titulaire;
    }

    public function deposer(string $intitule, float $montant):void{
        $this->verifierSomme($montant);
        $this->solde += $montant;
        $this->operations[]=Operation::credit($intitule,$montant);
    }

    public function retirer(string $intitule, float $montant):void{
        $this->verifierSomme($montant);
        if($montant>$this->getSolde()){
            $this->solde -= $montant;
            $this->operations[]=Operation::debit($intitule,$montant);
        }
    }

    private function verifierSomme(float $montant):void{
        if($montant<0){
            throw new \Exception("Le montant doit être strictement positif");
        }
    }

    public function __toString(): string
    {
        return "$this->titulaire : $this->solde";
    }
}