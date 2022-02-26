<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SubcatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubcatlistController extends AbstractController
{
    /**
     * @Route("/subcatlist/{id}", name="subcatlist")
     */
    public function index(CategoryRepository $repocat, $id): Response
    {
        $categories = $repocat->findAll();
        $subcat = $repocat->find($id);
        $list = $subcat->getSubcats();

        return $this->render('subcatlist/index.html.twig', [
            'categories' => $categories,
            'list' => $list
        ]);
    }
}
