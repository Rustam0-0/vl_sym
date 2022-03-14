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
    public function index(UserRepository $user, CategoryRepository $repocat, OrderRepository $ord): Response
    {
        $idclient = $user->find($this->getUser())->getClient();
     //   dd($idclient);
        $orderClient = $ord->findBy(['client'=>$idclient]);
       // dd($orderClient);
        $categories = $repocat->findAll();
//        $client = $repord->find($idclient);
//        $list = $client->getOrders();
dump($orderClient);
        return $this->render('my_orders/index.html.twig', [
            'categories' => $categories,
            'orders' => $orderClient,
            'controller_name' => 'MyOrdersController'
        ]);
    }
}
