<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

		/**
		 * @param Request $request
		 * @return Response
		 */
    #[Route('/panier/', name: 'cart')]
    public function index(Request $request)
    {
	      $products = $request->request->get('cart');

	      dump($products);

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
