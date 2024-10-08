<?php

// On require l'autoload

require_once __DIR__ . "/../vendor/autoload.php";

// On met le use de la classe qu'on veut

use \App\MotADeviner;
use \App\JeuPendu;

$mot1 = new MotADeviner();
//print_r($mot1->getMotCache());
$jeu1 = new JeuPendu($mot1);
$jeu1->jouer();