<?php

namespace App\Controller;

use App\Entity\ProductImage;
use App\Form\ProductImageType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductFormType;
use App\Entity\Product;
use App\Service\AdminService;

class AdminProductController extends AbstractController {

	#[Route('/admin/produits/ajouter/', name: 'admin_products_add')]
	public function index(Request $request, AdminService $adminService): Response {
		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

		$product = new Product();

		$form = $this->createForm(ProductFormType::class, $product);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$product = $form->getData();

			$name = $product->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$product->setSlug($slug);
			$product->setUpdatedAt(new DateTime('now'));

			$imageFile = $form->get('image')->getData();

			if ($imageFile) {
				// Récupération du champ de formulaire "name"
				$img_name = $product->getNameImg();

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($img_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilename = uniqid() . '-' . $slug . '.' . $imageFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$imageFile->move(
							$this->getParameter('products_directory'),
							$newFilename
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$product->setImage($newFilename);
			}

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($product);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $product->getName() . '" a été ajouté avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/produits_add.html.twig', [
				'form'     => $form->createView(),
				'products' => $products,
		]);
	}


	#[Route('/admin/produits/modifier-{slug}-{id}/', name: 'admin_products_modify', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function modifier(Request $request, AdminService $adminService, $id): Response {
		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

		$product = $this->getDoctrine()->getRepository(Product::class)->find($id);

		$form = $this->createForm(ProductFormType::class, $product);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$product = $form->getData();

			$name = $product->getName();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);

			$product->setSlug($slug);
			$product->setUpdatedAt(new DateTime('now'));

			$imageFile = $form->get('image')->getData();

			if ($imageFile) {
				// Récupération du champ de formulaire "name"
				$img_name = $product->getNameImg();

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($img_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilename = uniqid() . '-' . $slug . '.' . $imageFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$imageFile->move(
							$this->getParameter('products_directory'),
							$newFilename
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$product->setImage($newFilename);
			}

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($product);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $product->getName() . '" a été modifié avec succès');
		}

		return $this->render('admin/produits_modify.html.twig', [
				'product'  => $product,
				'form'     => $form->createView(),
				'products' => $products,
		]);
	}


	#[Route('/admin/produits/modifier-{productSlug}-{productId}/ajouter-des-images/', name: 'admin_products_add_pictures', requirements: ['productSlug' => '[a-zA-Z0-9\-_]+'])]
	public function addPictures(Request $request, AdminService $adminService, $productId): Response {
		$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

		$image = new ProductImage();

		$form = $this->createForm(ProductImageType::class, $image);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$image = $form->getData();

			$imageFile = $form->get('image')->getData();

			if ($imageFile) {
				// Récupération du champ de formulaire "name"
				$name = $image->getName();

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilename = uniqid() . '-' . $slug . '.' . $imageFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$imageFile->move(
							$this->getParameter('products_directory'),
							$newFilename
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$image->setImage($newFilename);
			}

			$image->setProducts($product);
			$image->setUpdatedAt(new DateTime('now'));

			dump($image);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($image);
			$entityManager->flush();

			$this->addFlash("success", '"' . $image->getName() . '" a été ajoutée avec succès');
		}

		return $this->render('admin/products_pictures_add.html.twig', [
				'product' => $product,
				'form'    => $form->createView(),
		]);
	}


}
