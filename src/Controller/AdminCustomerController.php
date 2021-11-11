<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCustomerController extends AbstractController
{
    #[Route('/admin/clients/modify/', name: 'admin_customer_modify')]
    public function index(): Response
    {
        return $this->render('admin_customer/index.html.twig', [
            'controller_name' => 'AdminCustomerController',
        ]);
    }
}
