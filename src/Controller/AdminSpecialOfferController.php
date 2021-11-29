<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSpecialOfferController extends AbstractController
{
    #[Route('/admin/promotions/ajouter', name: 'admin_special_offer')]
    public function index(): Response
    {
	    $tickets = $this->getDoctrine()->getRepository(DiscountTicket::class)->findBy([], ['id' => 'DESC'], 3);

	    $ticket = new DiscountTicket();
	    $error = '';

	    $form = $this->createForm(DiscountTicketType::class, $ticket);

	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {

		    $ticket = $form->getData();

		    $entityManager = $this->getDoctrine()->getManager();
		    $entityManager->persist($ticket);
		    $entityManager->flush();

		    // Mise à jour des produits après ajout //
		    $tickets = $this->getDoctrine()->getRepository(DiscountTicket::class)->findBy([], ['id' => 'DESC'], 3);

		    $this->addFlash("success", 'Le bon de réduction " ' . $ticket->getCode() . '" a été ajouté avec succès');
		    // return $this->redirectToRoute('task_success');
	    }

	    return $this->render('admin/discount_ticket_add.html.twig', [
			    'form'     => $form->createView(),
			    'tickets' => $tickets,
			    'error'    => $error,
	    ]);
    }
}
