<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ClientRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MyOrdersController extends AbstractController
{
    /**
     * @Route("/my_orders", name="my_orders")
     */
    public function index(CategoryRepository $repocat, OrderRepository $ord): Response
    {
            // one way
            //$idclient = $user->find($this->getUser())->getClient();
            //dd($this->getUser());
            //$orderClient = $ord->findBy(['client'=>$idclient]);
            //dd($orderClient);

        // another way
        $orderClient = $ord->findBy(['client'=>$this->getUser()->getClient()]);
        $categories = $repocat->findAll();
            dump($orderClient);
        return $this->render('my_orders/index.html.twig', [
            'categories' => $categories,
            'orders' => $orderClient,
            'controller_name' => 'MyOrdersController'
        ]);
    }
}
