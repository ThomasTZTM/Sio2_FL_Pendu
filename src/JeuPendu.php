<?php


namespace App;

class JeuPendu
{
    protected MotADeviner $motADeviner;
    protected int $nbErreur;
    protected array $lettreProposer;

    public function __construct(MotADeviner $motADeviner){
        $this->motADeviner = $motADeviner;
        $this->nbErreur = "10";
        $this->lettreProposer = [];
    }

    public function jouer() : void {
        while ($this->nbErreur > 0) {
            echo "\nVous avez $this->nbErreur tentative pour trouver le mot cacher. \n";
            echo "Votre progression : ";
            $this->afficherMotCache();
            echo "\n";
            if(count($this->lettreProposer)>1){
                echo "Votre progression : ";
                foreach ($this->lettreProposer as $lettres) {
                    echo $lettres." ";
                }
            }
            echo "\n";
            $proposition = $this->demanderLettre();
            echo "Vérification de la tentative : \n";
            $this->traiterLettre($proposition);
            echo "Changement après votre tentative : ";
            $this->afficherMotCache();
            $resultat=$this->motADeviner->isComplete();
            if ($resultat == true) {
                echo "\n VOUS AVEZ GAGNER \n";
                die();
            }
            echo "\n ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
            echo "";
            $this->nbErreur--;
        }
        echo "\n PERDU \n";
        die();

    }

    public function afficherMotCache() : void{
        $tab = $this->motADeviner->getMotCache();
        foreach ($tab as $mot) {
            echo $mot;
        }
    }

    public function demanderLettre() : string{
        $lettre = readline("Entrer une lettre : ");
        if ((strlen($lettre) > 1) or is_numeric($lettre)) {
            echo "/!\ Merci de rentrer une lettre";
            sleep(1);
            echo "...";
            sleep(1);
            return "";
        }else{
            $this->lettreProposer[] = $lettre;
            return $lettre;
        }
    }

    public function traiterLettre(string $lettre) : void{
        $this->motADeviner->updateMotCache($lettre);
    }

}