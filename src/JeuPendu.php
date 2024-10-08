<?php

namespace App;

class JeuPendu
{
    protected MotADeviner $motADeviner;
    protected int $nbErreur;

    public function __construct(MotADeviner $motADeviner, int $nbErreur){
        $this->motADeviner = $motADeviner;
        $this->nbErreur = $nbErreur;
    }

    public function jouer() : void {
        while ($this->nbErreur > 0) {
            echo "\n Vous avez $this->nbErreur tentative pour trouver le mot cacher. \n";
            $this->afficherMotCache();
            echo "\n";
            $proposition = $this->demanderLettre();
            echo "Vérification de la tentative : \n";
            $this->traiterLettre($proposition);
            $this->afficherMotCache();
            $resultat=$this->motADeviner->isComplete();
            if ($resultat == true) {
                echo "\n VOUS AVEZ GAGNER \n";
                die();
            }
            echo "\n ..........................";
            echo "\n \n";
            $this->nbErreur--;
        }
        echo "\n PERDU \n";
        die();

    }

    public function afficherMotCache() : void{
        echo "$this->motADeviner->getMotCache()";
    }

    public function demanderLettre() : string{
        $lettre = readline("Entrer une lettre");
        return $lettre;
    }

    public function traiterLettre(string $lettre) : void{
        $this->motADeviner->updateMotCache($lettre);
    }

}