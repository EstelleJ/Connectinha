<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalsController extends AbstractController
{
    #[Route('/mentions-legales/', name: 'mentions_legales')]
    public function index(): Response
    {
        return $this->render('legals/index.html.twig', [
        ]);
    }

	#[Route('/conditions-generales-de-vente/', name: 'cgv')]
	public function cgv(): Response
	{
		return $this->render('legals/cgv.html.twig', [
		]);
	}
}
