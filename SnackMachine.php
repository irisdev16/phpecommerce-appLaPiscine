<?php

//je créé une classe "VendorMachine"
// j'assigne dedans les propriétés snacks(avec le tableau fournit), cashAmount et isOn

class VendorMachine{
    public $isOn = false;
    public $cashAmount = 0;
    public $snack = [];

    //je créé une méthode "construct" pour qu'à chaque instance de classe, le cashAmount soit toujours initier a zéro
    //et l'instance de classe doit contenir les snacks

    function __construct(){
        $this->cashAmount = 0;
        $this->snack = [
            [
            "name" => "Snickers",
            "price" => 1,
            "quantity" => 5
        ],
            [
                "name" => "Mars",
                "price" => 1.5,
                "quantity" => 5
            ],
            [
                "name" => "Twix",
                "price" => 2,
                "quantity" => 5
            ],
            [
                "name" => "Bounty",
                "price" => 2.5,
                "quantity" => 5
            ]];
    }

//je créé une méthode "turnMachineOn" qui précisera si la machine est allumé ou pas
    function turnMachineOn(){
        //j'initie une variable qui prend en compte l'heure actuelle
        $currentHour = new DateTime();

        //si l'heure actuelle est inférieure à 18h
        if ($currentHour->format('H') < 18) {
            //alors la machine est allumée
            $this->isOn = true;
            //sinon, la machine est éteinte
        } else {
            throw new Exception("La machine ne peut pas être allumée après 18h.");
        }
    }

    function turnMachineOff(){
        //j'initie une variable qui prend en compte l'heure actuelle
        $currentHour = new DateTime();
        //si l'heure actuelle est après 18h
        if ($currentHour->format('H') > 18) {
            //alors la machine est éteinte
            $this->isOn = false;
        }else {
            //sinon,si l'heure actuelle est avant 18h, affiche message machine ne peut pas être éteinte
            throw new Exception("La machine ne peut pas être éteinte avant 18h.");
        }
    }


//je créé une méthode "buySnack"
    function buySnack($snackName){
        //si la machine est allumée
        if ($this->isOn) {
            //je parcours chaque snack du tableau avec la clé et la valeur
            //la clé $key correspond aux différents snacks dans le tableau, position 0, 1 ou 2 etc (l'index du tableau)
            //la valeur $snack correspond aux snack présent dans la liste avec leur nom, quantité, prix
            foreach ($this->snack as $key => $snack) {
                //si le nom du snack du tableau correspond au snack recherché
                if ($snack['name'] == $snackName){
                    //et si le snack est en stock
                    if ($snack['quantity'] > 0) {
                        //on modifie la quantité en utilisant la clé $key
                        $this->snack[$key]['quantity'] -= 1;
                        // on ajoute le prix payé a l'argent présent dans la machine
                        $this->cashAmount += $snack['price'];
                     }else {
                        throw new Exception("Ce snack est en rupture de stock");
                    }
                }
            }
        }else {
            throw new Exception("La machine est éteinte, impossible d'acheter un snack");
        }
    }

//je créé une méthode "shootWithFoot"
    function shootWithFoot(){
        //si la machine est allumée
        if ($this->isOn) {
            //en tapant la machine du pied, je veux récupérer un snack
            //ici je cherche à obtenir l'index (la clé $key) d'un snack aléatoire
            $randomKey = array_rand($this->snack);

            //si le snack est en stock, alors je réduis la quantité du snack dans le stock
            //en parcourant de manière random l'index du tableau et en ciblant les quantités pour chaque snack
            if ($this->snack[$randomKey]["quantity"] > 0){
                //alors je diminue de 1 le snack qui est randomly tombé
                $this->snack[$randomKey]["quantity"] -= 1;
            }
            //si il y a de l'argent dans la machine
            if ($this->cashAmount > 0){
                //alors je fais en sorte de décrémenter la quantité de cash du tableau
                $this->cashAmount -= 1;
            }
        }
    }





}
//je simule ici des actions émises sur la machine par un seul humain par exemple
//ci dessous, je créé une instance de classe que j'appelle plusieurs fois pour plusieurs actions différentes
// (TurnMachinOn, BuySnack, ShootWithFoot, etc, etc.)
$VendorMachine1 = new VendorMachine();
$VendorMachine1->turnMachineOn();
$VendorMachine1->buySnack("Mars");
$VendorMachine1->buySnack("Mars");
$VendorMachine1->buySnack("Mars");
$VendorMachine1->shootWithFoot();



var_dump($VendorMachine1);