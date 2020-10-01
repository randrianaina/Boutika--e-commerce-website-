<?php

namespace App\Entity;

use App\Repository\TypesLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypesLivraisonRepository::class)
 */
class TypesLivraison
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
    private $libelle_livraison;

    /**
     * @ORM\Column(type="integer")
     */
    private $delai_livraison;

    /**
     * @ORM\Column(type="float")
     */
    private $frais_livraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleLivraison(): ?string
    {
        return $this->libelle_livraison;
    }

    public function setLibelleLivraison(string $libelle_livraison): self
    {
        $this->libelle_livraison = $libelle_livraison;

        return $this;
    }

    public function getDelaiLivraison(): ?int
    {
        return $this->delai_livraison;
    }

    public function setDelaiLivraison(int $delai_livraison): self
    {
        $this->delai_livraison = $delai_livraison;

        return $this;
    }

    public function getFraisLivraison(): ?string
    {
        return $this->frais_livraison;
    }

    public function setFraisLivraison(string $frais_livraison): self
    {
        $this->frais_livraison = $frais_livraison;

        return $this;
    }
}
