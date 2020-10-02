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
     * @ORM\ManyToOne(targetEntity=TypesLivraison::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_type_livraison;

    /**
     * @ORM\ManyToOne(targetEntity=AdresseLivraison::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_adresse_livraison;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_utilisateur;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $montant_commande;

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

    public function getIdUtilisateur(): ?Utilisateurs
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateurs $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getMontantCommande(): ?string
    {
        return $this->montant_commande;
    }

    public function setMontantCommande(string $montant_commande): self
    {
        $this->montant_commande = $montant_commande;

        return $this;
    }
}
