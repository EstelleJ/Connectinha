<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharteController extends AbstractController
{
    #[Route('/la-charte-ethique-du-magnetiseur-energeticien/', name: 'charte')]
    public function index(): Response
    {
        return $this->render('charte/index.html.twig', [
            'controller_name' => 'CharteController',
        ]);
    }
}
