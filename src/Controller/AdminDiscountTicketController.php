<?php

namespace App\Controller;

use App\Entity\DiscountTicket;
use App\Form\DiscountTicketType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDiscountTicketController extends AbstractController
{
    #[Route('/admin/bons-de-reductions/ajouter/', name: 'admin_discount_ticket_add')]
    public function index(Request $request): Response
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

		#[Route('/admin/bons-de-reductions/modifier-{id}/', name: 'admin_discount_ticket_modify')]
		public function modify(Request $request, $id): Response
		{
			$tickets = $this->getDoctrine()->getRepository(DiscountTicket::class)->findBy([], ['id' => 'DESC'], 3);

			$ticket = $this->getDoctrine()->getRepository(DiscountTicket::class)->find($id);
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

				$this->addFlash("success", 'Le bon de réduction "' . $ticket->getCode() . '" a été modifié avec succès');
				// return $this->redirectToRoute('task_success');
			}

			return $this->render('admin/discount_ticket_modify.html.twig', [
					'form'     => $form->createView(),
					'tickets' => $tickets,
					'error'    => $error,
			]);
		}
}
