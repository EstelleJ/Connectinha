<?php

namespace App\Controller;

use App\Entity\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrdersController extends AbstractController
{
    #[Route('/admin/commandes/commande-{id}/', name: 'admin_orders_modify')]
    public function index($id): Response
    {
    	  $order = $this->getDoctrine()->getRepository(Orders::class)->find($id);

        return $this->render('admin/orders_modify.html.twig', [
            'order' => $order
        ]);
    }
}
