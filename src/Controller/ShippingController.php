<?php

namespace App\Controller;

use App\Entity\FreeShipping;
use App\Entity\ShippingCost;
use App\Form\FreeShippingType;
use App\Form\ShippingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShippingController extends AbstractController
{
    #[Route('/admin/frais-de-ports/ajouter/', name: 'admin_shipping_add')]
    public function index(Request $request): Response
    {
	    $shippings = $this->getDoctrine()->getRepository(ShippingCost::class)->findBy([], ['id' => 'DESC'], 3);
	    $shipping = new ShippingCost();

	    $form = $this->createForm(ShippingType::class, $shipping);

	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {

		    $entityManager = $this->getDoctrine()->getManager();
		    $entityManager->persist($shipping);
		    $entityManager->flush();

		    // Mise à jour des produits après ajout //
		    $shippings = $this->getDoctrine()->getRepository(ShippingCost::class)->findBy([], ['id' => 'DESC'], 3);

		    $this->addFlash("success", 'La nouvelle tranche a été ajoutée avec succès');
		    // return $this->redirectToRoute('task_success');
	    }

        return $this->render('admin/shipping_add.html.twig', [
		        'form'     => $form->createView(),
		        'shippings' => $shippings,
        ]);
    }


		#[Route('/admin/frais-de-ports/modifier-{id}/', name: 'admin_shipping_modify')]
		public function modify(Request $request, $id): Response
		{
			$shippings = $this->getDoctrine()->getRepository(ShippingCost::class)->findBy([], ['id' => 'DESC'], 3);
			$shipping = $this->getDoctrine()->getRepository(ShippingCost::class)->find($id);

			$form = $this->createForm(ShippingType::class, $shipping);

			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {

				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($shipping);
				$entityManager->flush();

				// Mise à jour des produits après ajout //
				$shippings = $this->getDoctrine()->getRepository(ShippingCost::class)->findBy([], ['id' => 'DESC'], 3);

				$this->addFlash("success", 'La nouvelle tranche a été modifiée avec succès');
				// return $this->redirectToRoute('task_success');
			}

			return $this->render('admin/shipping_modify.html.twig', [
					'form'     => $form->createView(),
					'shippings' => $shippings,
			]);
		}

	#[Route('/admin/frais-de-ports/frais-de-ports-offerts/ajouter/', name: 'admin_shipping_free_add')]
	public function free_add(Request $request): Response
	{

		$freeShipping = new FreeShipping();

		$form = $this->createForm(FreeShippingType::class, $freeShipping);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($freeShipping);
			$entityManager->flush();

			$this->addFlash("success", 'La nouvelle gratuité de frais de port a été ajoutée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/free_shipping_add.html.twig', [
				'form'     => $form->createView(),
		]);
	}


	#[Route('/admin/frais-de-ports/frais-de-ports-offerts/modifier-1/', name: 'admin_shipping_free_modify')]
	public function free_modify(Request $request): Response
	{

		$freeShipping = $this->getDoctrine()->getRepository(FreeShipping::class)->find(1);

		$form = $this->createForm(FreeShippingType::class, $freeShipping);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($freeShipping);
			$entityManager->flush();

			$this->addFlash("success", 'La nouvelle gratuité de frais de port a été modifiée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/free_shipping_modify.html.twig', [
				'form'     => $form->createView(),
		]);
	}

}
