<?php
namespace App;
class MotADeviner
{
    protected array $ListeMot;
    protected array $TableauUnderscoreMot = [];
    public function __construct(array $ListeMot, array $TableauUnderscoreMot){
        $this->ListeMot = array_rand($ListeMot);
        $longueur = strlen($this->ListeMot);
        $TableauUnderscoreMot = [];
        for($i = 0; $i < $longueur; $i++){
            $TableauUnderscoreMot[] = "_";
        }
        $this->TableauUnderscoreMot = $TableauUnderscoreMot;
    }
    public function getMot() : string{
        return $this->ListeMot;
    }

    public function getMotCache() : array{
        return $this->TableauUnderscoreMot;
    }

    public function updateMotCache(string $lettre) : void{
        $mot_juste = [];
        foreach ($this->ListeMot as $UneLettre){
            $mot_juste[] = $UneLettre;
        }
        if (in_array($lettre, $mot_juste)){
            $nb_occurences = substr_count($this->ListeMot, $lettre);
            if($nb_occurences > 1){
                while ($nb_occurences > 0){
                    $emplacement = array_search($lettre, $mot_juste);
                    $mot_juste[$emplacement]="_";
                    $this->TableauUnderscoreMot[$emplacement] = "lettre";
                    $nb_occurences--;
                }
            }else{
                $emplacement = array_search($lettre, $mot_juste);
                $this->TableauUnderscoreMot[$emplacement] = "lettre";
            }
        }
    }

    public function isComplete() : bool{
        if (!(array_search("_", $this->TableauUnderscoreMot))){
            return true;
        }else{
            return false;
        }
    }
}
