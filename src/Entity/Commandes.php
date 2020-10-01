<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_commande;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_commande;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_client;

    /**
     * @ORM\ManyToOne(targetEntity=TypesLivraison::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_type_livraison;

    /**
     * @ORM\ManyToOne(targetEntity=AdresseLivraison::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_adresse_livraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getMontantCommande(): ?float
    {
        return $this->montant_commande;
    }

    public function setMontantCommande(float $montant_commande): self
    {
        $this->montant_commande = $montant_commande;

        return $this;
    }

    public function getIdClient(): ?Clients
    {
        return $this->id_client;
    }

    public function setIdClient(?Clients $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getIdTypeLivraison(): ?TypesLivraison
    {
        return $this->id_type_livraison;
    }

    public function setIdTypeLivraison(?TypesLivraison $id_type_livraison): self
    {
        $this->id_type_livraison = $id_type_livraison;

        return $this;
    }

    public function getIdAdresseLivraison(): ?AdresseLivraison
    {
        return $this->id_adresse_livraison;
    }

    public function setIdAdresseLivraison(?AdresseLivraison $id_adresse_livraison): self
    {
        $this->id_adresse_livraison = $id_adresse_livraison;

        return $this;
    }
}
