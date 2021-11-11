<?php

namespace App\Controller;

use App\Entity\ProductSubcategory;
use App\Form\ProductSubcategoryType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductSubcategoriesController extends AbstractController {

	#[Route('/admin/sous-categories/ajouter/', name: 'admin_subcategory_add')]
	public function subcategories(Request $request, AdminService $adminService): Response {
		// $categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['id' => 'DESC'], 3);
		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['id' => 'DESC'], 3);

		$subcategory = new ProductSubcategory();

		$form = $this->createForm(ProductSubcategoryType::class, $subcategory);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$subcategory = $form->getData();

			$name = $subcategory->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$subcategory->setSlug($slug);

			dump($subcategory);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($subcategory);
			$entityManager->flush();

			// Mise à jour des catégories après ajout //
			$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La sous-catégorie "' . $subcategory->getName() . '" a été ajoutée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/subcategories_add.html.twig', [
				'form'          => $form->createView(),
				'subcategories' => $subcategories,
		]);
	}


	#[Route('/admin/sous-categories/modifier-{slug}-{id}/', name: 'admin_subcategory_modify', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function modifier(Request $request, AdminService $adminService, $id): Response {
		//$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['id' => 'DESC'], 3);
		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['id' => 'DESC'], 3);

		$subcategory = $this->getDoctrine()->getRepository(ProductSubcategory::class)->find($id);

		$form = $this->createForm(ProductSubcategoryType::class, $subcategory);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$subcategory = $form->getData();

			$name = $subcategory->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$subcategory->setSlug($slug);

			dump($subcategory);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($subcategory);
			$entityManager->flush();

			// Mise à jour des catégories après ajout //
			$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La sous-catégorie "' . $subcategory->getName() . '" a été modifiée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/subcategories_modify.html.twig', [
				'form'          => $form->createView(),
				'subcategories' => $subcategories,
				'subcategory'   => $subcategory,
		]);
	}


}
