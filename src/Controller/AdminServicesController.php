<?php

namespace App\Controller;

use App\Entity\PaymentMethod;
use App\Entity\Services;
use App\Entity\ServicesContent;
use App\Form\PaymentMethodType;
use App\Form\ServicesContentType;
use App\Form\ServicesFormType;
use App\Service\AdminService;
use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class AdminServicesController extends AbstractController {

	#[Route('/admin/services/ajouter/', name: 'admin_services_add')]
	public function index(Request $request, AdminService $adminService): Response {

		$services = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['id' => 'DESC'], 3);

		$service = new Services();

		$form = $this->createForm(ServicesFormType::class, $service);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$service = $form->getData();

			$name = $service->getTitle();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);
			$service->setSlug($slug);
			$service->setActive(1);

			$service->setUpdatedAt(new DateTime('now'));

			$imageFile = $form->get('image')->getData();

			if ($imageFile) {
				// Récupération du champ de formulaire "name"
				$img_name = $slug;

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($img_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilename = uniqid() . '-' . $slug . '.' . $imageFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$imageFile->move(
							$this->getParameter('services_directory'),
							$newFilename
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$service->setImage($newFilename);
			}

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($service);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$services = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $service->getTitle() . '" a été ajouté avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/services_add.html.twig', [
				'form'     => $form->createView(),
				'services' => $services,
		]);
	}

	#[Route('/admin/services/modifier-{slug}-{id}/', name: 'admin_services_modify', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function modify(Request $request, AdminService $adminService, $id): Response {

		$service = $this->getDoctrine()->getRepository(Services::class)->find($id);
		$services = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['title' => 'ASC']);

		$form = $this->createForm(ServicesFormType::class, $service);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$service = $form->getData();

			$name = $service->getTitle();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);
			$service->setSlug($slug);
			$service->setActive(1);

			$service->setUpdatedAt(new DateTime('now'));

			$imageFile = $form->get('image')->getData();

			if ($imageFile) {
				// Récupération du champ de formulaire "name"
				$img_name = $slug;

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($img_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilename = uniqid() . '-' . $slug . '.' . $imageFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$imageFile->move(
							$this->getParameter('services_directory'),
							$newFilename
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$service->setImage($newFilename);
			}

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($service);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$services = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $service->getTitle() . '" a été modifié avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/services_modify.html.twig', [
				'form'     => $form->createView(),
				'services' => $services,
				'service'  => $service,
		]);
	}


	#[Route('/admin/services/modifier-{slug}-{id}/content-{page}/', name: 'admin_services_content', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function content(Request $request, AdminService $adminService, $id, $page, PaginationService $paginationService): Response {
		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(ServicesContent::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$contents = $this->getDoctrine()->getRepository(ServicesContent::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		$service = $this->getDoctrine()->getRepository(Services::class)->find($id);

		return $this->render('admin/services_content.html.twig', [
				'contents'        => $contents,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
				'service'         => $service,
		]);
	}

	#[Route('/admin/services/modifier-{slug}-{id}/ajouter-du-contenu/', name: 'admin_services_content_add', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function content_add(Request $request, AdminService $adminService, $id): Response {

		$contents = $this->getDoctrine()->getRepository(ServicesContent::class)->findBy([], ['id' => 'DESC'], 3);
		$service = $this->getDoctrine()->getRepository(Services::class)->find($id);

		$content = new ServicesContent();

		$form = $this->createForm(ServicesContentType::class, $content);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$content = $form->getData();

			$name = $content->getTitle();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);
			$content->setServices($service);

			$content->setUpdatedAt(new DateTime('now'));

			$imageFile = $form->get('image')->getData();
			$pdfFile = $form->get('pdf')->getData();

			if ($imageFile) {
				// Récupération du champ de formulaire "name"
				$img_name = $slug;

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($img_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilename = uniqid() . '-' . $slug . '.' . $imageFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$imageFile->move(
							$this->getParameter('services_directory'),
							$newFilename
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$content->setImage($newFilename);
			}

			if ($pdfFile) {
				// Récupération du champ de formulaire "name"
				$pdf_name = $slug;

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($pdf_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilenamePdf = uniqid() . '-' . $slug . '.' . $pdfFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$pdfFile->move(
							$this->getParameter('services_directory'),
							$newFilenamePdf
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$content->setPdf($newFilenamePdf);
			}

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($content);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$contents = $this->getDoctrine()->getRepository(ServicesContent::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $content->getTitle() . '" a été ajouté avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/services_content_add.html.twig', [
				'form'     => $form->createView(),
				'contents' => $contents,
				'service'  => $service,
		]);
	}

	#[Route('/admin/services/modifier-{slug}-{id}/contenu-{contentId}', name: 'admin_services_content_modify', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function content_modify(Request $request, AdminService $adminService, $id, $contentId): Response {

		$contents = $this->getDoctrine()->getRepository(ServicesContent::class)->findBy([], ['id' => 'DESC'], 3);
		$service = $this->getDoctrine()->getRepository(Services::class)->find($id);

		$content = $this->getDoctrine()->getRepository(ServicesContent::class)->find($contentId);

		$form = $this->createForm(ServicesContentType::class, $content);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$content = $form->getData();

			$name = $content->getTitle();

			// Appel de la fonction slug définie dans le service AdminService //
			$slug = $adminService->slugify($name);
			$content->setServices($service);

			$content->setUpdatedAt(new DateTime('now'));

			$imageFile = $form->get('image')->getData();
			$pdfFile = $form->get('pdf')->getData();

			if ($imageFile) {
				// Récupération du champ de formulaire "name"
				$img_name = $slug;

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($img_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilename = uniqid() . '-' . $slug . '.' . $imageFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$imageFile->move(
							$this->getParameter('services_directory'),
							$newFilename
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$content->setImage($newFilename);
			}

			if ($pdfFile) {
				// Récupération du champ de formulaire "name"
				$pdf_name = $slug;

				// Appel de la fonction slug définie dans le service AdminService //
				$slug = $adminService->slugify($pdf_name);

				// Nouveau nom de fichier : un identifiant unique + le slug du nom défini
				$newFilenamePdf = uniqid() . '-' . $slug . '.' . $pdfFile->guessExtension();

				// Enregistrement dans le dossier où les images sont stockées
				try {
					$pdfFile->move(
							$this->getParameter('services_directory'),
							$newFilenamePdf
					);
				}
				catch (FileException $e) {
					// ... handle exception if something happens during file upload
				}

				// Set du nom du fichier dans le champ "image"
				$content->setPdf($newFilenamePdf);
			}

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($content);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$contents = $this->getDoctrine()->getRepository(ServicesContent::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $content->getTitle() . '" a été ajouté avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/services_content_add.html.twig', [
				'form'     => $form->createView(),
				'contents' => $contents,
				'service'  => $service,
		]);
	}

}
