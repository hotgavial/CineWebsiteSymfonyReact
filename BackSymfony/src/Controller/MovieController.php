<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie-info/{id}", name="movie_info", methods={"GET"})
     */
    public function getMovieInfo(MovieRepository $movieRepository, $id): Response
    {
        $movies = $movieRepository->find($id);
        return $this->json($movies, 200, [], ['groups' => 'movie_info']);
    }

    /**
     * @Route("/user-grade/{idMovie}/{idUser}", name="user-grade", methods={"GET"})
     */
    public function getMovieGradeForUser(ReviewRepository $reviewRepository, $idMovie, $idUser): Response
    {
        $review = $reviewRepository->findOneBy(['user' => $idUser, 'movie' => $idMovie]);
        return $this->json($review, 200, [], ['groups' => 'review']);
    }
}
