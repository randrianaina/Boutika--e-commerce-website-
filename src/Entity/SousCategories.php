<?php

namespace App\Entity;

use App\Repository\SousCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousCategoriesRepository::class)
 */
class SousCategories
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
    private $libelle_sous_categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleSousCategorie(): ?string
    {
        return $this->libelle_sous_categorie;
    }

    public function setLibelleSousCategorie(string $libelle_sous_categorie): self
    {
        $this->libelle_sous_categorie = $libelle_sous_categorie;

        return $this;
    }

    public function getIdCategorie(): ?Categories
    {
        return $this->id_categorie;
    }

    public function setIdCategorie(?Categories $id_categorie): self
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }
}
