<?php

namespace App\Controller;

use App\Entity\PaymentMethod;
use App\Entity\Services;
use App\Form\PaymentMethodType;
use App\Form\ServicesFormType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class AdminServicesController extends AbstractController
{
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
				'form'    => $form->createView(),
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
				'form'    => $form->createView(),
				'services' => $services,
				'service' => $service
		]);
	}
}
