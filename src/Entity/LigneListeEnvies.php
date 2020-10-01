<?php

namespace App\Entity;

use App\Repository\LigneListeEnviesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigneListeEnviesRepository::class)
 */
class LigneListeEnvies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Articles::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_article;

    /**
     * @ORM\ManyToOne(targetEntity=ListeEnvies::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_liste_envies;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdListeEnvies(): ?ListeEnvies
    {
        return $this->id_liste_envies;
    }

    public function setIdListeEnvies(?ListeEnvies $id_liste_envies): self
    {
        $this->id_liste_envies = $id_liste_envies;

        return $this;
    }
}
