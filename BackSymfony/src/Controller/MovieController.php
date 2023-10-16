<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\MovieRepository;
use App\Repository\ReviewRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class MovieController extends AbstractController
{
    /**
     * @Route("/movie-info/{id}", name="movie_info", methods={"GET"})
     */
    public function getMovieInfo(MovieRepository $movieRepository, $id): Response
    {
        $movie = $movieRepository->find($id);
        return $this->json($movie, 200, [], ['groups' => 'movie_info']);
    }

    /**
     * @Route("/home-page-movies", name="home_page_movies", methods={"GET"})
     */
    public function getHomePageMovies(MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findBY([], [], 10);
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

    /**
     * @Route("/api/add-grade", name="add-review", methods={"POST"})
     */
    public function addMovieGradeForUser(Request $request, Security $security, MovieRepository $movieRepository, ObjectManager $manager): Response
    {
        $data = json_decode($request->getContent(), true);
        $grade = $data['grade'];
        $idMovie = $data['idMovie'];

        $authenticatedUser = $security->getUser();

        if ($grade > 0 && $grade < 11) {
            $movie = $movieRepository->find($idMovie);

            if (!$movie) {
                return new JsonResponse(['message' => 'Film non trouvé'], 404);
            }

            $review = new Review();
            $review->setMovie($movie);
            $review->setUser($authenticatedUser);
            $review->setGrade($grade);

            $manager->persist($review);
            $manager->flush();
        } else {
            throw new BadRequestHttpException('La note doit être comprise entre 1 et 10.');
        }

        return new JsonResponse(['message' => 'Note ajoutée avec succès']);
    }

    /**
     * @Route("/api/update-grade", name="update-review", methods={"PUT"})
     */
    public function updateMovieGradeForUser(Request $request, Security $security, ReviewRepository $reviewRepository, ObjectManager $manager): Response
    {
        $data = json_decode($request->getContent(), true);
        $grade = $data['grade'];
        $idReview = $data['idReview'];

        $authenticatedUser = $security->getUser();
        $userId = $authenticatedUser->getId();

        if ($grade > 0 && $grade < 11) {
            $review = $reviewRepository->find($idReview);

            if (!$review) {
                return new JsonResponse(['message' => 'Note non trouvé'], 404);
            }

            if ($userId !== $review->getUser()->getId()) {
                return new JsonResponse(['message' => 'Mauvais utilsiateur non trouvé'], 404);
            }

            $review->setGrade($grade);
            $manager->flush();
        } else {
            throw new BadRequestHttpException('La note doit être comprise entre 1 et 10.');
        }

        return new JsonResponse(['message' => 'Note ajoutée avec succès']);
    }
}
