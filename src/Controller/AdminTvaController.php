<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Tva;
use App\Form\TvaType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTvaController extends AbstractController {

	#[Route('/admin/tva/ajouter/', name: 'admin_tva_add')]
	public function index(Request $request, AdminService $adminService): Response {

		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

		$tva = new Tva();

		$form = $this->createForm(TvaType::class, $tva);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$tva = $form->getData();

			$name = $tva->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$tva->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($tva);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La taxe "' . $tva->getName() . '" a été ajoutée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/tva_add.html.twig', [
				'products' => $products,
				'form'     => $form->createView(),
		]);
	}


	#[Route('/admin/tva/modifier-{slug}-{id}/', name: 'admin_tva_modify', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function modifier(Request $request, AdminService $adminService, $id): Response {
		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

		$tva = $this->getDoctrine()->getRepository(Tva::class)->find($id);

		$form = $this->createForm(TvaType::class, $tva);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$tva = $form->getData();

			$name = $tva->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$tva->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($tva);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La taxe "' . $tva->getName() . '" a été modifiée avec succès');
		}

		return $this->render('admin/tva_modify.html.twig', [
				'tva'      => $tva,
				'form'     => $form->createView(),
				'products' => $products,
		]);
	}


}
