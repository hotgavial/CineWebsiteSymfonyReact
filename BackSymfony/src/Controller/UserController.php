<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Proxies\__CG__\App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;


class UserController extends AbstractController
{

    /**
     * @Route("/sign-up", name="test", methods={"POST"})
     */
    public function signUp(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository)
    {
        $pseudo = $request->request->get('pseudo');
        $password = $request->request->get('password');

        $existingUser = $userRepository->findOneBy(['pseudo' => $pseudo]);
        if ($existingUser !== null) {
            return new JsonResponse(['message' => 'Le pseudo est déjà pris'], Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setPseudo($pseudo);
        $hashedPassword = $passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
        $user->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($user);
        $entityManager->flush();
    }
}
