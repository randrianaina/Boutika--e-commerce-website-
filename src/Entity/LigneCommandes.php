<?php

namespace App\Entity;

use App\Repository\LigneCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigneCommandesRepository::class)
 */
class LigneCommandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_commande;

    /**
     * @ORM\ManyToOne(targetEntity=Articles::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdCommande(): ?Commandes
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commandes $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getIdArticle(): ?Articles
    {
        return $this->id_article;
    }

    public function setIdArticle(?Articles $id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }
}
