<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController {

	#[Route('/votre-espace-client/', name: 'profile')]
	public function index(): Response {

		$user = $this->getUser();

		return $this->render('user/index.html.twig', [
				'user' => $user,
		]);
	}

	#[Route('/votre-espace-client/votre-panier-sauvegarde/', name: 'profile_cart_saved')]
	public function cartSaved(): Response {

		$user = $this->getUser();
		$cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user' => $user], ['id' => 'DESC']);

		$array_cart = $cart->getProductArray();
		$json_cart = implode(",", $array_cart);

		$saved_products = json_decode($json_cart);

		$arrayProducts = [];

		$mantraSelected = null;

		foreach ($saved_products as $cartProduct) {

			$productId = $cartProduct->id;
			$quantity = $cartProduct->quantity;
			$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

			array_push($arrayProducts, $product);

			dump($saved_products);

			if($cartProduct->id == $product->getId()){
				$mantraSelected = $cartProduct->mantra;
			}

		}

		dump($arrayProducts);

		return $this->render('user/cart.html.twig', [
				'user'           => $user,
				'cart'           => $cart,
				'arrayProducts'  => $arrayProducts,
				'mantraSelected' => $mantraSelected,
				'quantity'       => $quantity,
		]);
	}

}
