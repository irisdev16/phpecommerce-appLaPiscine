<?php

// je créé une class  Order
class Order {

    //j'assigne à la classe une propriété "id"
    public $id;
    //j'assigne à la classe une propriété "customerName"
    public $customerName;
    //j'assigne à la classe une propriété "status"
    public $status = "cart";
    //j'assigne à la classe une propriété "totalPrice"
    public $totalPrice = 0;
    //j'assigne à la classe une propriété "products"
    public $products = [];
    //j'assigne à la classe une propriété "shippingAdress"
    public $shippingAddress;



    // je créé une méthode construct :
    //le constructeur est une méthode "magique" car elle est appelé automatiquement quand l'instance de classe est créé
    public function __construct($customerName){
        // j'initie avec this qui fait référence à l'instance de classe actuel, je donne un nom à ma variable qui ici est le même
        //que la propriété de ma méthode et de ma classe, j'appelle la propriété
        $this->customerName = $customerName;

        // idem pour this ici, je dis que la propriété id aura un identifiant unique
        $this->id = uniqid();
    }


    //je créé une méthode (fonction) "addProduct" qui permet l'ajout d'un produit
    // le $this n'a de sens qu'à l'intérieur de ma class, il fait référence à l'instance de classe actuel c'est-à-dire a Order1,
    // Order2, etccc.  donc à l'instance de classe actuel issu de la class.
    public function addProduct(){
        //condition : si le status de la commande est "cart" (donc produits dans le panier)
        if ($this->status = "cart"){
            //alors ajouter dans le tableau de produits "pringles" (en supposant qu'il n'y ai que des pringles à vendre)
            $this->products[] = "pringles";
            //et alors le prix de la commande augmente de 3 (sous entendu 3 euros par paquet de pringles)
            $this->totalPrice += 3;
        }
    }

    //je créé une méthode "removeProduct" qui permet de supprimer un produit dans une commande en cours
    public function removeProduct(){
        //si le statut de ma commande est "cart" et donc en cours
        if ($this->status === "cart"){
            //et si mon tableau n'est pas vide
            if (!empty($this->products)) {
                //alors je supprime le dernier élément de mon tableau de produits
                array_pop($this->products);
                //et alors je diminue le prix de 3 puisqu'un paquet de pringles vaut 3 euros
                $this->totalPrice -= 3;
            } else {
                throw new Exception("Attention, il n'y a pas de produits dans votre panier");
            }
        }
    }



    public function setShippingAddress($shippingAddress){
        if ($this->status === "cart"){
            $this->$shippingAddress = $shippingAddress;
            $this->status = "shippingAdressSet";
        }else {
            throw new Exception("Vous n'avez rien dans votre panier, vous ne pouvez pas entrer une adresse de livraison");
        }
    }


    //je créé une méthode "pay" qui permet de payer la commande
    public function pay() {
        //condition : si le statut de la commande est "cart"
        if ($this->status === "shippingAdressSet" && !empty($this->products)){
            //le passer a "paid"
            $this->status = "paid";
        } else {
            throw new Exception("Vous ne pouvez pas payer, merci de rentrer votre adresse d'abord.");
        }
    }


    //je créé une méthode "envoi de la commande"
    public function sendOrder(){
        //condition : si la commande est payée
        if ($this->status == "paid"){
            // alors je peux indiquer que la commande est envoyée
            $this->status = "send";
        }else {
            throw new Exception("La commande ne peut pas être expédiée, elle n'est pas encore payée.");

        }
    }

}



//Exemple 1 : je créé une nouvelle commande, j'ajoute 2 produits, et je paie
//je créé une instance de classe Order1
$order1 = new Order("Amélie Poulain", "3 rue de la Boetie");
$order1->addProduct();
$order1->addProduct();
$order1->pay();

//Exemple 2 : je créé une nouvelle commande,j'ajoute 2 produits, je retire un produit
//Je créé une instance de classe Order2
$order2 = new Order("Gandalf");
$order2->addProduct();
$order2->addProduct();
$order2->removeProduct();

//Exemple 3 : je créé une nouvelle commande, je passe en paramètre le nom du client (ici mon nom), j'aoute 2 articles et je paie
// je créé une instance de classe Order3
$order3 = new Order("Iris Dettori");
$order3->addProduct();
$order3->addProduct();
$order3->pay();

//Exemple 3 : je créé une nouvelle commande, je passe en paramètre le nom du client , j'ajoute 2 articles, je paie et j'envoie
//je créé une instance de classe Order4
$order4 = new Order("Emilie");
$order4->addProduct();
$order4->addProduct();
$order4->sendOrder();
$order4->setShippingAddress($this->shippingAddress);

//Exemple 4 : je créé une nouvelle commande, je passe en paramètre le nom du client, j'ajoute 2 articles, je paie et j'envoie
var_dump($order4);