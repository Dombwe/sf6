<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todo')]

class TodoController extends AbstractController
{
    #[Route('/', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        if (!$session->has('todos')) {
            $todos = [
                'achat' => 'Acheter clé USB',
                'cours' => 'Finaliser mon cours',
                'correction' => 'Corriger mes examens',
            ];
            $session->set('todos', $todos);
            $this->addFlash("info", "La liste des todos vient d'etre initialisée.");
        } 

        return $this->render('todo/index.html.twig');
    }

    // Utilisation des valeurs par default
    #[Route(
        '/add/{name}/{content?sf6}', 
        name: 'todo.add',
    )]
    public function addTodo(Request $request, $name, $content): RedirectResponse {

        $session = $request->getSession();

        if ($session->has('todos')) {

            $todos = $session->get('todos');
            if(isset($todos[$name])) {
                $this->addFlash("error", "Le todo $name existe deja dans la liste!");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos); 
                $this->addFlash("success", "Le todo $name a été ajouté avec success!");
            }

        } else {
            $this->addFlash("error", "La liste des todos n'est pas encore initialisée.");
        }
        return $this->redirectToRoute('todo');

    }

    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): RedirectResponse {

        $session = $request->getSession();
        if ($session->has('todos')) {
            
            $todos = $session->get('todos');
            if(isset($todos[$name])) {
                $todos[$name] = $content;
                $session->set('todos', $todos); 
                $this->addFlash("success", "Le todo $name a été modifié avec success!");
            } else {
                $this->addFlash("error", "Le todo $name n'existe pas encore!");
            }

        } else {
            $this->addFlash("error", "La liste des todos n'est pas encore initialisée.");
        }
        return $this->redirectToRoute('todo');

    }

    #[Route('/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): RedirectResponse {

        $session = $request->getSession();
        if ($session->has('todos')) {
            
            $todos = $session->get('todos');
            if(isset($todos[$name])) {
                unset($todos[$name]);
                $session->set('todos', $todos); 
                $this->addFlash("success", "Le todo $name a été supprimé avec success!");
            } else {
                $this->addFlash("error", "Le todo $name n'existe pas encore!");
            }

        } else {
            $this->addFlash("error", "La liste des todos n'est pas encore initialisée.");
        }
        return $this->redirectToRoute('todo');

    }

    #[Route('/reset', name: 'todo.reset')]
    public function resetTodo(Request $request): RedirectResponse {
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('todo');
    }

    // Utilisation des requirements
    #[Route(
        'multi/{entier1<\d+>}/{entier2<\d+>}',
        name: 'multiplication',
    )]
    public function multiplication($entier1, $entier2){
        $resultat = $entier1 * $entier2;
    }


    #[Route('/template', name: 'template')]
    public function template() {
        return $this->render('template.html.twig');
    }
}

