<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingupController extends AbstractController
{
    /**
     * @Route("/singup", name="singup")
     */
    public function singup(CategoryRepository $repocat, Request $request): Response
    {
        $categories = $repocat->findAll();
        $form = $this->createForm(ClientType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            //dd($task);

            $cli = new Client();
            $cli->setName($task["name"]);
            $cli->setName($task["surname"]);
            $cli->setName($task["address"]);
            $cli->setName($task["address_complete"]);
            $cli->setName($task["zipcode"]);
            $cli->setName($task["city"]);
            $cli->setName($task["country"]);
            $cli->setName($task["name"]);
            $cli->setName($task["name"]);


            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('home');
        }

        return $this->render('singup/index.html.twig', [
            'categories' => $categories,
            'form' => $form->createView()

        ]);
    }
}
