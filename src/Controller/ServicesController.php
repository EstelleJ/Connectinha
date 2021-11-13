<?php

namespace App\Controller;

use App\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('/mes-services/', name: 'services')]
    public function index(): Response
    {
    	$services = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['title' => 'ASC']);

        return $this->render('services/index.html.twig', [
            'services' => $services
        ]);
    }
}
