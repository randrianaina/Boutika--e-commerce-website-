<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
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
    private $libelle_article;

    /**
     * @ORM\Column(type="float")
     */
    private $prixHT_article;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_article;

    /**
     * @ORM\ManyToOne(targetEntity=SousCategories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_sous_categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleArticle(): ?string
    {
        return $this->libelle_article;
    }

    public function setLibelleArticle(string $libelle_article): self
    {
        $this->libelle_article = $libelle_article;

        return $this;
    }

    public function getPrixHTArticle(): ?float
    {
        return $this->prixHT_article;
    }

    public function setPrixHTArticle(float $prixHT_article): self
    {
        $this->prixHT_article = $prixHT_article;

        return $this;
    }

    public function getImageArticle(): ?string
    {
        return $this->image_article;
    }

    public function setImageArticle(string $image_article): self
    {
        $this->image_article = $image_article;

        return $this;
    }

    public function getIdSousCategorie(): ?SousCategories
    {
        return $this->id_sous_categorie;
    }

    public function setIdSousCategorie(?SousCategories $id_sous_categorie): self
    {
        $this->id_sous_categorie = $id_sous_categorie;

        return $this;
    }
}
