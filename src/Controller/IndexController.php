<?php

namespace App\Controller;

use App\Entity\HomeContent;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController {

	#[Route('/', name: 'index')]
	public function index(): Response {

		$content = $this->getDoctrine()->getRepository(HomeContent::class)->find(1);
		$favourites = $this->getDoctrine()->getRepository(Product::class)->findBy([
				                                                                          'active' => 1,
				                                                                          'favourite' => 1
		                                                                          ], ['id' => 'DESC'], 3);

		return $this->render('index/index.html.twig', [
				'favourites' => $favourites,
				'content' => $content
		]);
	}
}
