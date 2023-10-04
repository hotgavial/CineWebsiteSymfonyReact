<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 * @ORM\Table(name="reviews")
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idReview", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("review")
     */
    private $grade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("review")
     */
    private $review;

    /**
     * @ORM\ManyToOne(targetEntity=Movie::class, inversedBy="reviews")
     * @ORM\JoinColumn(name="idMovie", referencedColumnName="idMovie", nullable=false)
     */
    private $movie;

    /**
     * @ORM\JoinColumn(name="idUser", referencedColumnName="idUser", nullable=false)
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="users")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getMovie(): ?movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
