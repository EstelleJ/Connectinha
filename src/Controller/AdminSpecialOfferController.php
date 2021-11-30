<?php

namespace App\Controller;


use App\Entity\SpecialOffer;
use App\Form\SpecialOfferType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSpecialOfferController extends AbstractController {

	#[Route('/admin/promotions/ajouter', name: 'admin_special_offers_add')]
	public function index(Request $request, AdminService $adminService): Response {
		$offers = $this->getDoctrine()->getRepository(SpecialOffer::class)->findBy([], ['id' => 'DESC'], 3);

		$offer = new SpecialOffer();
		$error = '';

		$form = $this->createForm(SpecialOfferType::class, $offer);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$offer = $form->getData();

			$name = $offer->getTitle();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$offer->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($offer);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$offers = $this->getDoctrine()->getRepository(SpecialOffer::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La promotion " ' . $offer->getTitle() . '" a été ajoutée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/special_offers_add.html.twig', [
				'form'   => $form->createView(),
				'offers' => $offers,
				'error'  => $error,
		]);
	}

	#[Route('/admin/promotions/modifier-{id}', name: 'admin_special_offers_modify')]
	public function modify($id, Request $request, AdminService $adminService): Response {
		$offers = $this->getDoctrine()->getRepository(SpecialOffer::class)->findBy([], ['id' => 'DESC'], 3);

		$offer = $this->getDoctrine()->getRepository(SpecialOffer::class)->find($id);
		$error = '';

		$form = $this->createForm(SpecialOfferType::class, $offer);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$offer = $form->getData();

			$name = $offer->getTitle();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$offer->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($offer);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$offers = $this->getDoctrine()->getRepository(SpecialOffer::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La promotion " ' . $offer->getTitle() . '" a été modifiée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/special_offers_modify.html.twig', [
				'form'   => $form->createView(),
				'offers' => $offers,
				'error'  => $error,
		]);
	}


}
