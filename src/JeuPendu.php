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
            if(count($this->lettreProposer)>0){
                echo "\nLettres déjà proposé : ";
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
                echo "\nVOUS AVEZ GAGNER !!! \n";
                die();
            }
            echo "\n ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
            echo "";
            $this->nbErreur--;
        }
        echo "\nPERDU \n";
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
        $lettre = strtoupper($lettre);
        if ((strlen($lettre) > 1) or is_numeric($lettre) or !ctype_alpha($lettre)) {
            echo "/!\ Merci de rentrer une lettre";
            sleep(1);
            echo "...";
            sleep(1);
            return "";
        }elseif (in_array($lettre, $this->lettreProposer)) {
            echo "/!\ Vous avez déjà entrer cette lettre";
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