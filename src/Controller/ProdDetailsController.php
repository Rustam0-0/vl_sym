<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdDetailsController extends AbstractController
{
    /**
     * @Route("/prod_details/{id}", name="prod_details")
     */
    public function index(CategoryRepository $repocat, ProductRepository $prod, $id): Response
    {
        $categories = $repocat->findAll();

        return $this->render('prod_details/index.html.twig', [
            'product' => $prod->find($id),
            'categories' => $categories,
        ]);
    }
}
