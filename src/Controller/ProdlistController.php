<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SubcatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdlistController extends AbstractController
{
    /**
     * @Route("/prodlist", name="prodlist")
     */
    public function index(CategoryRepository $repocat, ProductRepository $repoprod): Response
    {
        $categories = $repocat->findAll();
        $list = $repoprod->findAll();
        return $this->render('prodlist/index.html.twig', [
            'categories' => $categories,
            'list' => $list
        ]);
    }

    /**
     * @Route("/prodlist2/{id}", name="prodlist2")
     */
    public function index2(CategoryRepository $repocat, SubcatRepository $repoprod, $id): Response
    {
        $categories = $repocat->findAll();
        $subcat = $repoprod->find($id);
        $list = $subcat->getProducts();

        return $this->render('prodlist/index.html.twig', [
            'categories' => $categories,
            'list' => $list,
        ]);
    }

    /**
     * @Route("/prodlist3/{id}", name="prodlist3")
     */
    public function index3(CategoryRepository $repocat, ProductRepository $repoprod, $id): Response
    {
        $categories = $repocat->findAll();
        $list = $repoprod->findByCategory($id);

        return $this->render('prodlist/index.html.twig', [
            'categories' => $categories,
            'list' => $list,
        ]);
    }
}
