<?php

namespace App\Controller;

use App\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController {

	#[Route('/votre-espace-client/', name: 'profile')]
	public function index(): Response {

		$user = $this->getUser();

		return $this->render('user/index.html.twig', [
				'user' => $user
		]);
	}

	#[Route('/votre-espace-client/votre-panier-sauvegarde/', name: 'profile_cart_saved')]
	public function cartSaved(): Response {

		$user = $this->getUser();

		return $this->render('user/cart.html.twig', [
				'user' => $user
		]);
	}

}
