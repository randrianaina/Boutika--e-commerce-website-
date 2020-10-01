<?php

namespace App\Entity;

use App\Repository\AdresseLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseLivraisonRepository::class)
 */
class AdresseLivraison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_contact;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_contact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomContact(): ?string
    {
        return $this->nom_contact;
    }

    public function setNomContact(string $nom_contact): self
    {
        $this->nom_contact = $nom_contact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenom_contact;
    }

    public function setPrenomContact(string $prenom_contact): self
    {
        $this->prenom_contact = $prenom_contact;

        return $this;
    }

    public function getAdresseContact(): ?string
    {
        return $this->adresse_contact;
    }

    public function setAdresseContact(string $adresse_contact): self
    {
        $this->adresse_contact = $adresse_contact;

        return $this;
    }

    public function getCpContact(): ?int
    {
        return $this->cp_contact;
    }

    public function setCpContact(int $cp_contact): self
    {
        $this->cp_contact = $cp_contact;

        return $this;
    }

    public function getVilleContact(): ?string
    {
        return $this->ville_contact;
    }

    public function setVilleContact(string $ville_contact): self
    {
        $this->ville_contact = $ville_contact;

        return $this;
    }
}
