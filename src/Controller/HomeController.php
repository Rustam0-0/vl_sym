<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $repocat, ProductRepository $repoprod): Response
    {
        $categories = $repocat->findAll();
        $list = $repoprod->findAll();
        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'list' => $list,
//            'controller_name' => 'BaseController',
        ]);
    }
}
