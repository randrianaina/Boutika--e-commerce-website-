<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $libelle_categorie;

    /**
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="categories")
     */
    private $id_article;

    public function __construct()
    {
        $this->id_article = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCategorie(): ?string
    {
        return $this->libelle_categorie;
    }

    public function setLibelleCategorie(string $libelle_categorie): self
    {
        $this->libelle_categorie = $libelle_categorie;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getIdArticle(): Collection
    {
        return $this->id_article;
    }

    public function addIdArticle(Articles $idArticle): self
    {
        if (!$this->id_article->contains($idArticle)) {
            $this->id_article[] = $idArticle;
            $idArticle->setCategories($this);
        }

        return $this;
    }

    public function removeIdArticle(Articles $idArticle): self
    {
        if ($this->id_article->contains($idArticle)) {
            $this->id_article->removeElement($idArticle);
            // set the owning side to null (unless already changed)
            if ($idArticle->getCategories() === $this) {
                $idArticle->setCategories(null);
            }
        }

        return $this;
    }
}
