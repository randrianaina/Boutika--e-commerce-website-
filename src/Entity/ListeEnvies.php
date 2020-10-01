<?php

namespace App\Entity;

use App\Repository\ListeEnviesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeEnviesRepository::class)
 */
class ListeEnvies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateurs::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_utilisateur;

    public function getIdUtilisateur(): ?Utilisateurs
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(Utilisateurs $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}
