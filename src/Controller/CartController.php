<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;
use App\Repository\CategoryRepositoryRepository;
use App\Repository\ClientRepositoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class CartController extends AbstractController
{
    /**
     * @Route("/cart/add", name="cart_add")
     */
    public function index(SessionInterface $session,ProductRepository $prod, Request $request): Response
    {
//        return $this->render('cart/index.html.twig', [
//            'controller_name' => 'CartController',
//        ]);
        $cart = $session->get("cart", []);


        if ($request->getMethod() == 'POST') {
            $product = $prod->find($request->get('id'));
            $cart[$request->get('id')] = [
                "label" => $request->get('label'),
                "model" => $request->get('model'),
                "picture" => $request->get('picture'),
                "qty" => $request->get('qty'),
                "stock" => $product->getStock()
            ];
            $session->set("cart", $cart);
        }
        dump($cart);

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }

    /**
     * @Route("/cart", name="cart")
     */
    public function cart(CategoryRepository $repocat, SessionInterface $session, ProductRepository $prod, Request $request): Response
    {
        $cart = $session->get("cart", []);

        foreach ($cart as $key=>$value) {
            $product = $prod->find($key);
            $cart[$key]['price']=$product->getPrice();
        }
 dump($product);
        $categories = $repocat->findAll();
        return $this->render('cart/index.html.twig', [
            'categories' => $categories,
            'cart' => $cart,
        ]);

    }


}
