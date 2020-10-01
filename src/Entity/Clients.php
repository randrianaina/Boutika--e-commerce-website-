<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $civilite_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_client;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motdepasse_client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCiviliteClient(): ?string
    {
        return $this->civilite_client;
    }

    public function setCiviliteClient(string $civilite_client): self
    {
        $this->civilite_client = $civilite_client;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): self
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenom_client;
    }

    public function setPrenomClient(string $prenom_client): self
    {
        $this->prenom_client = $prenom_client;

        return $this;
    }

    public function getAdresseClient(): ?string
    {
        return $this->adresse_client;
    }

    public function setAdresseClient(string $adresse_client): self
    {
        $this->adresse_client = $adresse_client;

        return $this;
    }

    public function getCpClient(): ?int
    {
        return $this->cp_client;
    }

    public function setCpClient(int $cp_client): self
    {
        $this->cp_client = $cp_client;

        return $this;
    }

    public function getVilleClient(): ?string
    {
        return $this->ville_client;
    }

    public function setVilleClient(string $ville_client): self
    {
        $this->ville_client = $ville_client;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->email_client;
    }

    public function setEmailClient(string $email_client): self
    {
        $this->email_client = $email_client;

        return $this;
    }

    public function getMotdepasseClient(): ?string
    {
        return $this->motdepasse_client;
    }

    public function setMotdepasseClient(string $motdepasse_client): self
    {
        $this->motdepasse_client = $motdepasse_client;

        return $this;
    }
}
