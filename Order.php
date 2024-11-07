<?php

// je créé une class  Order
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


    //je créé une méthode (fonction) "addProduct" qui permet l'ajout d'un produit
    // le $this n'a de sens qu'à l'intérieur de ma class, il fait référence à l'objet actuel c'est-à-dire a Order1,
    // Order2, etccc.  donc à l'objet actuel issu de la class.
    public function addProduct(){
        //condition : si le status de la commande est "cart" (donc produits dans le panier)
        if ($this->status = "cart"){
            //alors ajouter dans le tableau de produits "pringles" (en supposant qu'il n'y ai que des pringles à vendre)
            $this->products[] = "pringles";
            //et alors le prix de la commande augmente de 3 (sous entendu 3 euros par paquet de pringles)
            $this->totalPrice += 3;
        }
    }

    //je créé une méthode "pay" qui permet de payer la commande
    public function pay() {
        //condition : si le statut de la commande est "cart"
        if ($this->status === "cart"){
            //le passer a "paid"
            $this->status = "paid";
        }
    }

    //je créé une méthode "removeProduct" qui permet de supprimer un produit dans une commande en cours
    public function removeProduct(){
        //si le statut de ma commande est "cart" et donc en cours
        if ($this->status === "cart"){
            //alors je supprimer le dernier élément de mon tableau de produits
            array_pop($this->products);
            $this->totalPrice -= 3;
        }
    }

}

//je créé un objet Order1
$order1 = new Order();
$order1->addProduct();
$order1->addProduct();
$order1->removeProduct();

var_dump($order1);