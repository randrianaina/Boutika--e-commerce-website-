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
     * @ORM\OneToOne(targetEntity=Clients::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?Clients
    {
        return $this->id_client;
    }

    public function setIdClient(Clients $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }
}
