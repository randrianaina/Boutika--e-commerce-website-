<?php
namespace App\Entity;
use App\Repository\PanierRepository;

class Panier
{   
    private $id;
    private $lignes_panier = [];
    private $montant_panier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLignesPanier(): ?array
    {
        return $this->lignes_panier;
    }

    public function setLignesPanier(?array $lignes_panir): self
    {
        $this->lignes_panier = $lignes_panier;

        return $this;
    }

    public function getMontantPanier(): ?float
    {
        return $this->montant_panier;
    }

    public function setMontantPanier(?float $montant_panier): self
    {
        $this->montant_panier = $montant_panier;

        return $this;
    }

    public function add_ligne($id)
    {
        if (isset($this->lignes_panier[$id])) {
            //create a new line and add it if empty
            $this->lignes_panier[$id] ++;
        } else {
            $this->lignes_panier[$id] =1;
        }
    }

    //méthode pour la décrémentation de la valeur d'une ligne de panier
    public function del_ligne($id)
    {
        //Si une ligne de panier avec comme clé l'identifiant du produit séléctionné existe
        if (isset($this->lignes_panier[$id])) {
            //décrémente sa valeur
            $this->lignes_panier[$id] --;

            //si valeur de la ligne de panier = 0 alors suppression de la ligne de l'article concerné par le programme
            if ($this->lignes_panier[$id] == 0)
        {
            //désinitialise la ligne
            unset($this->lignes_panier[$id]);
        }
    }
}

    //méthode pour la suppression d'une ligne
    public function del_all_ligne($id)
    {   
        //Si une ligne de panier avec comme clé l'identifiant du produit séléctionné existe
        if (isset($this->lignes_panier[$id])) {
            // désinitialise la ligne
            unset($this->lignes_panier[$id]);
        }
    }

   
}
    

    
