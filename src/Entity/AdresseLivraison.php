<?php

namespace App\Entity;

use App\Repository\AdresseLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Type("string")
     */
    private $nom_contact;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $prenom_contact;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $adresse_contact;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="digit", message="Le code postal {{ value }} n'est pas valide."
     * )
     */
    private $cp_contact;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $ville_contact;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="adresselivraison")
     */
    private $id_utilisateur;

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

    public function getIdUtilisateur(): ?Utilisateurs
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateurs $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}
