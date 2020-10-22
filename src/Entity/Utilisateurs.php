<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateursRepository::class)
 * @UniqueEntity(fields={"email_utilisateur"}, message="There is already an account with this email_utilisateur")
 */
class Utilisateurs implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email_utilisateur;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $civilite_utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_utilisateur;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp_utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=AdresseLivraison::class, mappedBy="id_utilisateur")
     */
    private $adresselivraison;

    /**
     * @ORM\OneToMany(targetEntity=Commandes::class, mappedBy="id_utilisateur", orphanRemoval=true)
     */
    private $commandes;

    public function __construct()
    {
        $this->adresselivraison = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailUtilisateur(): ?string
    {
        return $this->email_utilisateur;
    }

    public function setEmailUtilisateur(string $email_utilisateur): self
    {
        $this->email_utilisateur = $email_utilisateur;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email_utilisateur;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCiviliteUtilisateur(): ?string
    {
        return $this->civilite_utilisateur;
    }

    public function setCiviliteUtilisateur(string $civilite_utilisateur): self
    {
        $this->civilite_utilisateur = $civilite_utilisateur;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): self
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }

    public function setPrenomUtilisateur(string $prenom_utilisateur): self
    {
        $this->prenom_utilisateur = $prenom_utilisateur;

        return $this;
    }

    public function getAdresseUtilisateur(): ?string
    {
        return $this->adresse_utilisateur;
    }

    public function setAdresseUtilisateur(string $adresse_utilisateur): self
    {
        $this->adresse_utilisateur = $adresse_utilisateur;

        return $this;
    }

    public function getCpUtilisateur(): ?int
    {
        return $this->cp_utilisateur;
    }

    public function setCpUtilisateur(int $cp_utilisateur): self
    {
        $this->cp_utilisateur = $cp_utilisateur;

        return $this;
    }

    public function getVilleUtilisateur(): ?string
    {
        return $this->ville_utilisateur;
    }

    public function setVilleUtilisateur(string $ville_utilisateur): self
    {
        $this->ville_utilisateur = $ville_utilisateur;

        return $this;
    }

    /**
     * @return Collection|AdresseLivraison[]
     */
    public function getAdresselivraison(): Collection
    {
        return $this->adresselivraison;
    }

    public function addAdresselivraison(AdresseLivraison $adresselivraison): self
    {
        if (!$this->adresselivraison->contains($adresselivraison)) {
            $this->adresselivraison[] = $adresselivraison;
            $adresselivraison->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeAdresselivraison(AdresseLivraison $adresselivraison): self
    {
        if ($this->adresselivraison->contains($adresselivraison)) {
            $this->adresselivraison->removeElement($adresselivraison);
            // set the owning side to null (unless already changed)
            if ($adresselivraison->getIdUtilisateur() === $this) {
                $adresselivraison->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getIdUtilisateur() === $this) {
                $commande->setIdUtilisateur(null);
            }
        }

        return $this;
    }
}
