<?php

namespace App\Controller;

use App\Entity\Cart;
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

	      $cart = $this->getDoctrine()->getRepository(Cart::class)->findAll();

	      dump($cart);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart
        ]);
    }
}
