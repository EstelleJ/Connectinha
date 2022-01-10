<?php

namespace App\Controller;

use App\Entity\PaymentMethod;
use App\Form\PaymentMethodType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPaymentMethodsController extends AbstractController {

	#[Route('/admin/moyens-de-paiement/ajouter/', name: 'admin_payment_methods_add')]
	public function index(Request $request, AdminService $adminService): Response {

		$methods = $this->getDoctrine()->getRepository(PaymentMethod::class)->findBy([], ['id' => 'DESC'], 3);

		$method = new PaymentMethod();

		$form = $this->createForm(PaymentMethodType::class, $method);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$method = $form->getData();

			$name = $method->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);
			$method->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($method);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$methods = $this->getDoctrine()->getRepository(PaymentMethod::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $method->getName() . '" a été ajouté avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/payment_methods_add.html.twig', [
				'form'    => $form->createView(),
				'methods' => $methods,
		]);
	}

	#[Route('/admin/moyens-de-paiement/modifier-{slug}-{id}/', name: 'admin_payment_methods_modify', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function modify(Request $request, AdminService $adminService, $id): Response {

		$methods = $this->getDoctrine()->getRepository(PaymentMethod::class)->findBy([], ['id' => 'DESC'], 3);
		$method = $this->getDoctrine()->getRepository(PaymentMethod::class)->find($id);

		$form = $this->createForm(PaymentMethodType::class, $method);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$method = $form->getData();

			$name = $method->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);
			$method->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($method);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$methods = $this->getDoctrine()->getRepository(PaymentMethod::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $method->getName() . '" a été modifié avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/payment_methods_modify.html.twig', [
				'form'    => $form->createView(),
				'methods' => $methods,
		]);
	}
}
