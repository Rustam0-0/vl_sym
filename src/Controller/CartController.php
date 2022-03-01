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
    public function cartAdd(SessionInterface $session, ProductRepository $prod, Request $request): Response
    {
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
     * @Route("/cart/update", name="cart_update")
     */
    public function cartUpdate(SessionInterface $session, ProductRepository $prod, Request $request): Response
    {
        $cart = $session->get("cart", []);
        if ($request->getMethod() == 'POST') {
            $product = $prod->find($request->get('id'));
            $id = $request->get('id');
            if($request->get('qty')<=0){
                unset($cart[$id]);
            }
            else{
                if($request->get('qty')<= $product->getStock()){
                    $cart[$id]["qty"]=$request->get('qty');
                }
            }
            $session->set("cart", $cart);
        }
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }

    /**
     * @Route("/cart", name="cart")
     */
    public function index(CategoryRepository $repocat, SessionInterface $session, ProductRepository $prod): Response
    {
        $cart = $session->get("cart", []);

        foreach ($cart as $key => $value) {
            $product = $prod->find($key);
            $cart[$key]['price'] = $product->getPrice();
        }

        $categories = $repocat->findAll();
        return $this->render('cart/index.html.twig', [
            'categories' => $categories,
            'cart' => $cart,
        ]);

    }


}
