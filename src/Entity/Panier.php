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
}
