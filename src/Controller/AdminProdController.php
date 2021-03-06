<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/prod")
 */
class AdminProdController extends AbstractController
{
    /**
     * @Route("/", name="admin_prod_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, CategoryRepository $repocat): Response
    {
        $categories = $repocat->findAll();
        return $this->render('admin_prod/index.html.twig', [
            'categories' => $categories,
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_prod_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, CategoryRepository $repocat): Response
    {
        $categories = $repocat->findAll();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setDateAdd(new \DateTime());
//            dd($request);
            $aMimeTypes = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/x-png", "image/tiff");
            //   $img = ['product']['photo'];
            $objfichier = $request->files->get('product');
            $fichier = $objfichier['picture'];
            if (!empty($fichier)) {
                if (in_array($fichier->getClientmimeType(), $aMimeTypes)) {
                    if ($fichier->move('assets/images/PRODUCTS/', $fichier->getClientOriginalName())) {
                        $product->setPicture($fichier->getClientOriginalName());
                    }
                }
            }
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('success', 'Produit est ajout??');
            return $this->redirectToRoute('admin_prod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prod/new.html.twig', [
            'categories' => $categories,
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_prod_show", methods={"GET"})
     */
    public function show(Product $product, CategoryRepository $repocat): Response
    {
        $categories = $repocat->findAll();
        return $this->render('admin_prod/show.html.twig', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_prod_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager, CategoryRepository $repocat): Response
    {
        $categories = $repocat->findAll();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setDateUpdate(new \DateTime());
            $entityManager->flush();

            $this->addFlash('success', 'Produit est edit??');
            return $this->redirectToRoute('admin_prod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prod/edit.html.twig', [
            'categories' => $categories,
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_prod_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            if ($product->getPicture()) {
                unlink('assets/images/PRODUCTS/' . $product->getPicture());
            }
            $entityManager->remove($product);
            $entityManager->flush();

            $this->addFlash('success', 'Produit est effac??');
        }
        return $this->redirectToRoute('admin_prod_index', [], Response::HTTP_SEE_OTHER);
    }
}
