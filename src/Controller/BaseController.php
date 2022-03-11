<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("base", name="base")
     */
    public function index(CategoryRepository $repocat, ProductRepository $repoprod): Response
    {
        $categories = $repocat->findAll();
        $list = $repoprod->findAll();
        return $this->render('base.html.twig', [
            'categories' => $categories,
            'list' => $list
        ]);
    }
}
