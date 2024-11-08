<?php

//je créé une classe "VendorMachine"
// j'assigne dedans les propriétés snacks, cashAmount et isOn
class VendorMachine{
    private $isOn;
    private $cashAmount;
    private $snack;

    //je créé une méthode "construct" pour qu'à chaque instance de classe, le cashAmount soit toujours initier a zéro
    //et l'instance de classe doit contenir les snacks
    public function __construct(){
        $this->isOn = false;
        $this->cashAmount = 0.00;
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

//je créé une méthode "turnMachineOn" qui allume la machine
    public function turnMachineOn(){
        $this->isOn = true;
    }

    public function turnMachineOff(){
        //j'initie une variable qui prend en compte la date actuelle
        $currentDate = new DateTime();
        //j'initie une variable qui prend en compte l'heure actuelle
        $currentHour = $currentDate->format('H');

        //si l'heure actuelle est après 18h
        if ($currentHour >= 18) {
            //alors la machine est éteinte
            $this->isOn = false;
        }else {
            //sinon,si l'heure actuelle est avant 18h, affiche message machine ne peut pas être éteinte
            throw new Exception("La machine ne peut pas être éteinte avant 18h.");
        }
    }


//je créé une méthode "buySnack"
    public function buySnack($snackName){
        //si la machine est allumée
        if ($this->isOn) {
            $snackFound = false;

            //je parcours chaque snack du tableau avec la clé et la valeur
            //la clé $key correspond aux différents snacks dans le tableau, position 0, 1 ou 2 etc (l'index du tableau)
            //la valeur $snack correspond aux snack présent dans la liste avec leur nom, quantité, prix
            foreach ($this->snack as $key => $snack) {
                //si le nom du snack du tableau correspond au snack recherché
                if ($snack['name'] == $snackName){
                    //et si le snack est en stock
                    if ($snack['quantity'] > 0) {
                        //on modifie la quantité en utilisant la clé $key
                        $this->removeSnackQuantity($key);
                        // on ajoute le prix payé a l'argent présent dans la machine
                        $this->cashAmount += $snack['price'];
                     }else {
                        throw new Exception("Ce snack est en rupture de stock");
                    }
                    $snackFound = true;
                    break;
                }
            }
         if (!$snackFound){
             throw new Exception("Ce snack n'existe pas");
         }
        }
    }

//je créé une méthode "shootWithFoot"
    public function shootWithFoot()
    {
        //si la machine est allumée
        if ($this->isOn) {
            $randomIndex = rand(0, count($this->snack) - 1);
            $randomSnack = $this->snack[$randomIndex];

            if ($randomSnack ['quantity'] > 0) {
                $this->removeSnackQuantity($randomIndex);
            }

            $randomInsideCash = rand(0, $this->cashAmount * 100)/100;
            $this->cashAmount -= $randomInsideCash;

        }
    }

    private function removeSnackQuantity ($index){
        $this ->snack[$index]['quantity'] -= 1;
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