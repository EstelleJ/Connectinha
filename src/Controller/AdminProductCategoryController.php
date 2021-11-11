<?php

namespace App\Controller;

use App\Entity\ProductSubcategory;
use App\Form\ProductCategoryType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProductCategory;

class AdminProductCategoryController extends AbstractController {

	#[Route('/admin/categories/ajouter/', name: 'admin_category_add')]
	public function index(Request $request, AdminService $adminService): Response {

		$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['id' => 'DESC'], 3);
		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['name' => 'ASC']);

		$category = new ProductCategory();

		$form = $this->createForm(ProductCategoryType::class, $category);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$category = $form->getData();

			$name = $category->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$category->setSlug($slug);

			dump($category);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($category);
			$entityManager->flush();

			// Mise à jour des catégories après ajout //
			$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La catégorie "' . $category->getName() . '" a été ajoutée avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/categories_add.html.twig', [
				'form'          => $form->createView(),
				'categories'    => $categories,
				'subcategories' => $subcategories,
		]);
	}


	#[Route('/admin/categories/modifier-{slug}-{id}/', name: 'admin_category_modify', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function modifier(Request $request, AdminService $adminService, $id): Response {
		$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['id' => 'DESC'], 3);
		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['name' => 'ASC']);

		$category = $this->getDoctrine()->getRepository(ProductCategory::class)->find($id);

		$form = $this->createForm(ProductCategoryType::class, $category);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$category = $form->getData();

			$name = $category->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$category->setSlug($slug);

			dump($category);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($category);
			$entityManager->flush();

			// Mise à jour des catégories après ajout //
			$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", 'La catégorie "' . $category->getName() . '" a été modifiée avec succès');
		}

		return $this->render('admin/categories_modify.html.twig', [
				'category'      => $category,
				'form'          => $form->createView(),
				'categories'    => $categories,
				'subcategories' => $subcategories,
		]);
	}


}
