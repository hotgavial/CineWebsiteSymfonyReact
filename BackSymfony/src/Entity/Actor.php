<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ActorRepository::class)
 * @ORM\Table(name="actors")
 */
class Actor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idActor", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="firstName", type="string", length=25, nullable=true)
     * @Groups("movie_info")
     */
    private $firstName;

    /**
     * @ORM\Column(name="lastName", type="string", length=25)
     * @Groups("movie_info")
     */
    private $lastName;

    /**
     * @ORM\Column(name="hasBadge", type="boolean")
     */
    private $hasBadge;

    /**
     * @ORM\Column(name="isMale", type="boolean")
     * @Groups("movie_info")
     */
    private $isMale;

    /**
     * @ORM\OneToMany(targetEntity=ActorMovie::class, mappedBy="actor", orphanRemoval=true)
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function isHasBadge(): ?bool
    {
        return $this->hasBadge;
    }

    public function setHasBadge(bool $hasBadge): self
    {
        $this->hasBadge = $hasBadge;

        return $this;
    }

    public function isIsMale(): ?bool
    {
        return $this->isMale;
    }

    public function setIsMale(bool $isMale): self
    {
        $this->isMale = $isMale;

        return $this;
    }

    /**
     * @return Collection<int, ActorMovie>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(ActorMovie $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setActor($this);
        }

        return $this;
    }

    public function removeRole(ActorMovie $role): self
    {
        if ($this->roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getActor() === $this) {
                $role->setActor(null);
            }
        }

        return $this;
    }
}
