<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tab')]

class UserController extends AbstractController
{
    #[Route('/', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }

    #[Route('/users', name: 'tab.users')]
    public function users(): Response
    {
        $users = [
            ['firstname' => 'aymen', 'name' => 'sellaouti', 'age' => 39],
            ['firstname' => 'skander', 'name' => 'sellaouti', 'age' => 3],
            ['firstname' => 'souheib', 'name' => 'youssfi', 'age' => 59],
        ];

        return $this->render(
            'user/index.html.twig', [
                "users" => $users
            ]
        );
    }
}
