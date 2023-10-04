<?php

namespace App\Entity;

use App\Repository\ActorMovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ActorMovieRepository::class)
 * @ORM\Table(name="actors_movies")
 */
class ActorMovie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idActorsMovies", type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Movie::class, inversedBy="cast")
     * @ORM\JoinColumn(name="idMovie", referencedColumnName="idMovie", nullable=false)
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity=Actor::class, inversedBy="roles")
     * @ORM\JoinColumn(name="idActor", referencedColumnName="idActor", nullable=false)
     * @Groups("movie_info")
     */
    private $actor;

    /**
     * @ORM\Column(type="string", length=30)
     * @Groups("movie_info")
     */
    private $job;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getActor(): ?Actor
    {
        return $this->actor;
    }

    public function setActor(?Actor $actor): self
    {
        $this->actor = $actor;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }
}
