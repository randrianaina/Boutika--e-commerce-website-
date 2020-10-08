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
     * @ORM\Column(type="string", length=255)
     */
    private $image_article;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_article;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_ttc_article;

    /**
     * @ORM\ManyToOne(targetEntity=SousCategories::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sousCategories;

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

    
    public function getImageArticle(): ?string
    {
        return $this->image_article;
    }

    public function setImageArticle(string $image_article): self
    {
        $this->image_article = $image_article;

        return $this;
    }
   

    public function getDescriptionArticle(): ?string
    {
        return $this->description_article;
    }

    public function setDescriptionArticle(string $description_article): self
    {
        $this->description_article = $description_article;

        return $this;
    }

    public function getPrixTtcArticle(): ?string
    {
        return $this->prix_ttc_article;
    }

    public function setPrixTtcArticle(string $prix_ttc_article): self
    {
        $this->prix_ttc_article = $prix_ttc_article;

        return $this;
    }

    public function getSousCategories(): ?SousCategories
    {
        return $this->sousCategories;
    }

    public function setSousCategories(?SousCategories $sousCategories): self
    {
        $this->sousCategories = $sousCategories;

        return $this;
    }
}
