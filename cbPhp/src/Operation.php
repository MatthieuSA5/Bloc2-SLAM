<?php

namespace Acme;

class Operation
{
    private string $intitule;
    private float $montant;
    private TypeOperation $typeOperation;
    private \DateTime $date;

   public function __construct(string $intitule, float $montant, TypeOperation $typeOperation){
       $this->intitule = $intitule;
       $this->montant = $montant;
       $this->typeOperation = $typeOperation;
       $this->date = new \DateTime();
   }
    public function getIntitule(): string
    {
        return $this->intitule;
    }
    public function getMontant(): float
    {
        return $this->montant;
    }
    public static function credit(string $intitule, float $montant):Operation{
        return new Operation($intitule, $montant, typeOperation::Credit);
    }

    public static function debit(string $intitule, float $montant):Operation{
        return new Operation($intitule, $montant, typeOperation::Debit);
    }
}