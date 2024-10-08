<?php
namespace App;
class MotADeviner
{
    protected array $ListeMot;
    protected string $LeMotsADeviner;
    protected int $LongueurMot;
    protected array $TableauUnderscoreMot;
    public function __construct(){
        $this->ListeMot = ["vert","bleub","rouge","noire"];
        $this->LeMotsADeviner = $this->ListeMot[array_rand($this->ListeMot)];
        $longueur = strlen($this->LeMotsADeviner);
        $TableauUnderscoreMot = [];
        for($i = 0; $i < $longueur; $i++){
            $TableauUnderscoreMot[] = "_";
        }
        $this->TableauUnderscoreMot = $TableauUnderscoreMot;
        $this->LongueurMot = strlen($this->LeMotsADeviner);
    }
    public function getMot() : string{
        return $this->LeMotsADeviner;
    }

    public function getMotCache() : array{
        return $this->TableauUnderscoreMot;
    }

    public function updateMotCache(string $lettre) : void{
        $mot_juste = [];
        for ($i=0; $i < $this->LongueurMot; $i++) {
            $mot_juste[$i] = $this->LeMotsADeviner[$i];
        }
        if (in_array($lettre, $mot_juste)){
            $emplacement=Null;
            $nb_occurences = substr_count($this->LeMotsADeviner, $lettre);
            if($nb_occurences > 1){
                while ($nb_occurences > 0){
                    $emplacement = array_search($lettre, $mot_juste);
                    $mot_juste[$emplacement]="_";
                    $this->TableauUnderscoreMot[$emplacement] = "$lettre";
                    $nb_occurences--;
                }
            }else{
                $emplacement = array_search($lettre, $mot_juste);
                $this->TableauUnderscoreMot[$emplacement] = "$lettre";
            }
        }
    }

    public function isComplete() : bool{
        $cpt = 0;
        $tab = $this->TableauUnderscoreMot;
        foreach ($tab as $lettre) {
            if ($lettre == "_"){
                $cpt++;
            };
        }
        if ($cpt == 0){
            return true;
        }else{
            return false;
        }
    }
}
