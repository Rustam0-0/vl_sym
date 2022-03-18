<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\CategoryRepository;
//use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
//use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdDetController extends AbstractController
{
    /**
     * @Route("/ord_det/{order}", name="ord_det")
     */
    public function index(CategoryRepository $repocat, Order $order): Response
    {
        $categories = $repocat->findAll();
        return $this->render('ord_det/index.html.twig', [
            'categories' => $categories,
            'order' => $order,
            'controller_name' => 'OrdDetController',
        ]);
    }

//    /**
//     * @Route("/bill/{order}", name="bill")
//     */
//    public function index2(Pdf $knpSnappyPdf, Order $order): Response
//    {
//        $html = $this->renderView('facture/index.html.twig', array(
//            'order' => $order
//        ));
//        return new PdfResponse(
//            $knpSnappyPdf->getOutputFromHtml($html),
//            'facture-numero-' . $order->getId() . '.pdf'
//        );
//    }

//    /**
//     * Export to PDF
//     *
//     * @Route("/pdf", name="acme_demo_pdf")
//     */
//    public function pdfAction()
//    {
//        $html = $this->renderView('AppBundle:Demo:pdf.html.twig');
//
//        $filename = sprintf('test-%s.pdf', date('Y-m-d'));
//
//        return new Response(
//            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
//            200,
//            [
//                'Content-Type'        => 'application/pdf',
//                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
//            ]
//        );
//    }
}
