<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 * @ORM\Table(name="movies")
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idMovie", type="integer")
     * @Groups("movie_info")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("movie_info")
     */
    private $title;

    /**
     * @ORM\Column(name="originalTitle", type="string", length=255, nullable=true)
     * @Groups("movie_info")
     */
    private $originalTitle;

    /**
     * @ORM\Column(type="integer")
     * @Groups("movie_info")
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("movie_info")
     */
    private $trailer;

    /**
     * @ORM\OneToMany(targetEntity=ActorMovie::class, mappedBy="movie", orphanRemoval=true)
     * @Groups("movie_info")
     */
    private $cast;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="movie")
     */
    private $reviews;

    public function __construct()
    {
        $this->cast = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(?string $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    /**
     * @return Collection<int, ActorMovie>
     */
    public function getCast(): Collection
    {
        return $this->cast;
    }

    public function addCast(ActorMovie $cast): self
    {
        if (!$this->cast->contains($cast)) {
            $this->cast[] = $cast;
            $cast->setMovie($this);
        }

        return $this;
    }

    public function removeCast(ActorMovie $cast): self
    {
        if ($this->cast->removeElement($cast)) {
            // set the owning side to null (unless already changed)
            if ($cast->getMovie() === $this) {
                $cast->setMovie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setMovie($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getMovie() === $this) {
                $review->setMovie(null);
            }
        }

        return $this;
    }

    /**
     * @SerializedName("averageRating")
     * @Groups("movie_info")
     */
    public function getAverageRating(): ?float
    {
        $reviews = $this->getReviews();

        if ($reviews->isEmpty()) {
            return null;
        }

        $totalRating = 0;
        $numberOfReviews = $reviews->count();

        foreach ($reviews as $review) {
            $totalRating += $review->getGrade();
        }

        $average = $totalRating / $numberOfReviews;

        return round($average, 2);
    }
}
