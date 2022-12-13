<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/first')]
class FirstController extends AbstractController
{
    #[Route('/', name: 'first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name' => 'Sellaouti',
            'firstname' => 'Aymen'
        ]);
    }

    #[Route('/sayHello/{name}/{firstname}', name: 'say.hello')]
    public function sayHello($name, $firstname): Response {

        return $this->render('first/hello.html.twig', [
            'name' => $name,
            'firstname' => $firstname,
        ]);

    }
}
