<?php

// je créé un objet Order
class Order {

    //j'assigne à l'objet une propriété "id"
    public $id;
    //j'assigne à l'objet une propriété "customerName"
    public $customerName;
    //j'assigne à l'objet une propriété "status"
    public $status = "cart";
    //j'assigne à l'objet une propriété "totalPrice"
    public $totalPrice = 0;
    //j'assigne à l'objet une propriété "products"
    public $products = [];


    //je créé une fonction "addProduct" qui permet l'ajout d'un produit
    public function addProduct(){
        //condition : si le status de la commande est "cart" (donc produits dans le panier)
        if ($this->status = "cart"){
            //alors ajouter dans le tableau de produits "pringles" (en supposant qu'il n'y ai que des pringles à vendre)
            $this->products[] = "pringles";
            //et alors le prix de la commande augmente de 3 (sous entendu 3 euros par paquet de pringles)
            $this->totalPrice += 3;
        }
    }

    //je créé une fonction "pay" qui permet de payer la commande
    public function pay() {
        //condition : si le statut de la commande est "cart"
        if ($this->status == "cart"){
            //le passer a "paid"
            $this->status = "paid";
        }
    }

}

$order1 = new Order();
$order1->addProduct();
$order1->pay();

var_dump($order1);