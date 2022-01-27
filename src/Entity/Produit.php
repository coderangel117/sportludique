<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=User::class)
     */
    private $Panier;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="Produit")
     */
    private $User;

    public function __construct()
    {
        $this->Panier = new ArrayCollection();
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPanier(): Collection
    {
        return $this->Panier;
    }

    public function addPanier(User $panier): self
    {
        if (!$this->Panier->contains($panier)) {
            $this->Panier[] = $panier;
        }

        return $this;
    }

    public function removePanier(User $panier): self
    {
        $this->Panier->removeElement($panier);

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(Avis $user): self
    {
        if (!$this->User->contains($user)) {
            $this->User[] = $user;
            $user->setProduit($this);
        }

        return $this;
    }

    public function removeUser(Avis $user): self
    {
        if ($this->User->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProduit() === $this) {
                $user->setProduit(null);
            }
        }

        return $this;
    }
}
