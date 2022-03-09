<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Repository\CategoryRepository;
use App\Repository\CountryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ValidController extends AbstractController
{
    /**
     * @Route("/valid", name="valid")
     */
    public function index(SessionInterface $session, ProductRepository $prod, CountryRepository $repcount, CategoryRepository $repocat, Request $request, EntityManagerInterface $em): Response
    {
        dump($this->getUser());
        $categories = $repocat->findAll();
        $list_countries = $repcount->findAll();
        $cart = $session->get("cart", []);
        foreach ($cart as $key => $value) {
            $product = $prod->find($key);
            $cart[$key]['price'] = $product->getPrice();
        }

        if ($request->isMethod("post")) {
            $name = $request->get("name");
            $surname = $request->get("surname");
            $address = $request->get("address");
            $zipcode = $request->get("zipcode");
            $city = $request->get("city");
            $country = $request->get("country");
            $countries = $repcount->find($country);

            $ord = new Order();
            $ord->setShipName($name);
            $ord->setShipSurname($surname);
            $ord->setShipAddress($address);
            $ord->setShipZipcode($zipcode);
            $ord->setShipCity($city);
            $ord->setCountry($countries);
            $ord->setDate(new \DateTime());

            $det = new OrderDetail();
            $det ->

            $em->persist($ord);
            $em->persist($det);
            $em->flush();
        }

        return $this->render('valid/index.html.twig', [
            'categories' => $categories,
            'countries' => $list_countries,
            'controller_name' => 'ValidController',
            'cart' => $cart,
            'user' => $this->getUser()
        ]);
    }
}
