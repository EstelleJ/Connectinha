<?php

namespace App\Controller;

use App\Entity\Days;
use App\Entity\Distance;
use App\Entity\Duration;
use App\Entity\Hours;
use App\Entity\Rendezvous;
use App\Entity\Unavailable;
use App\Form\DaysType;
use App\Form\DistanceType;
use App\Form\DurationType;
use App\Form\HoursType;
use App\Form\RendezvousType;
use App\Form\UnavailableType;
use App\Service\AdminService;
use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAgendaController extends AbstractController {


	// CRUD DES RENDEZ-VOUS
	#[Route('/agenda/voir-les-rendez-vous-{page}/', name: 'admin_agenda_rdv', methods: ['GET', 'POST'])]
	public function agenda_rdv(Request $request, PaginationService $paginationService, $page): Response {

		$nbElements = 8;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Rendezvous::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$rdvs = $this->getDoctrine()->getRepository(Rendezvous::class)->findBy([], ['id' => 'ASC'], $nbElements, $offset);

		return $this->renderForm('admin/agenda/agenda_rdvs.html.twig', [
				'rdvs'            => $rdvs,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	#[Route('/agenda/voir-les-rendez-vous/ajouter/', name: 'admin_agenda_rdv_add', methods: ['GET', 'POST'])]
	public function agenda_rdvs_add(Request $request, AdminService $adminService): Response {
		$rdv = new Rendezvous();
		$form = $this->createForm(RendezvousType::class, $rdv);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($rdv);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_rdv_add', [], Response::HTTP_SEE_OTHER);
		}

		$rdvs = $this->getDoctrine()->getRepository(Rendezvous::class)->findBy([], ['id' => 'ASC']);

		return $this->renderForm('admin/agenda/agenda_rdvs_add.html.twig', [
				'rdv'  => $rdv,
				'form' => $form,
				'rdvs' => $rdvs,
		]);
	}

	#[Route('/agenda/voir-les-rendez-vous/modifier-{id}/', name: 'admin_agenda_rdv_modify', methods: ['GET', 'POST'])]
	public function agenda_rdvs_modify(Request $request, $id, AdminService $adminService): Response {
		$rdv = $this->getDoctrine()->getRepository(Rendezvous::class)->find($id);

		$form = $this->createForm(RendezvousType::class, $rdv);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($rdv);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_rdv', [
					'page' => '1',
			],                            Response::HTTP_SEE_OTHER);
		}

		$rdvs = $this->getDoctrine()->getRepository(Rendezvous::class)->findBy([], ['id' => 'DESC']);

		return $this->renderForm('admin/agenda/agenda_rdvs_add.html.twig', [
				'rdv'  => $rdv,
				'form' => $form,
				'rdvs' => $rdvs,
		]);
	}

	#[Route('/agenda/voir-les-rendez-vous/delete-{id}/', name: 'admin_agenda_days_delete', methods: ['POST'])]
	public function agenda_rdvs_delete(Request $request, Rendezvous $rdv): Response {
		if ($this->isCsrfTokenValid('delete' . $rdv->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($rdv);
			$entityManager->flush();
		}

		return $this->redirectToRoute('admin_agenda_rdv', [
				'page' => '1',
		],                            Response::HTTP_SEE_OTHER);
	}



	// CRUD DES JOURS
	#[Route('/agenda/gerer-les-jours-{page}/', name: 'admin_agenda_days', methods: ['GET', 'POST'])]
	public function agenda_days(Request $request, PaginationService $paginationService, $page): Response {

		$nbElements = 8;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Days::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$days = $this->getDoctrine()->getRepository(Days::class)->findBy([], ['id' => 'ASC'], $nbElements, $offset);

		return $this->renderForm('admin/agenda/agenda_days.html.twig', [
				'days'            => $days,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	#[Route('/agenda/gerer-les-jours/ajouter/', name: 'admin_agenda_days_add', methods: ['GET', 'POST'])]
	public function agenda_days_add(Request $request, AdminService $adminService): Response {
		$day = new Days();
		$form = $this->createForm(DaysType::class, $day);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$toSlug = $form->get('name')->getData();
			$slug = $adminService->slugify($toSlug);

			$day->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($day);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_days_add', [], Response::HTTP_SEE_OTHER);
		}

		$days = $this->getDoctrine()->getRepository(Days::class)->findBy([], ['id' => 'ASC']);

		return $this->renderForm('admin/agenda/agenda_days_add.html.twig', [
				'day'  => $day,
				'form' => $form,
				'days' => $days,
		]);
	}

	#[Route('/agenda/gerer-les-jours/modifier-{id}/', name: 'admin_agenda_days_modify', methods: ['GET', 'POST'])]
	public function agenda_days_modify(Request $request, $id, AdminService $adminService): Response {
		$day = $this->getDoctrine()->getRepository(Days::class)->find($id);

		$form = $this->createForm(DaysType::class, $day);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$toSlug = $form->get('name')->getData();
			$slug = $adminService->slugify($toSlug);

			$day->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($day);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_days', [
					'page' => '1',
			],                            Response::HTTP_SEE_OTHER);
		}

		$days = $this->getDoctrine()->getRepository(Days::class)->findBy([], ['id' => 'DESC']);

		return $this->renderForm('admin/agenda/agenda_days_add.html.twig', [
				'day'  => $day,
				'form' => $form,
				'days' => $days,
		]);
	}

	#[Route('/agenda/gerer-les-jours/delete-{id}/', name: 'admin_agenda_days_delete', methods: ['POST'])]
	public function agenda_days_delete(Request $request, Days $day): Response {
		if ($this->isCsrfTokenValid('delete' . $day->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($day);
			$entityManager->flush();
		}

		return $this->redirectToRoute('admin_agenda_days', [
				'page' => '1',
		],                            Response::HTTP_SEE_OTHER);
	}




	// CRUD DES HORAIRES

	#[Route('/agenda/gerer-les-horaires-{page}/', name: 'admin_agenda_hours', methods: ['GET', 'POST'])]
	public function agenda_horaires(Request $request, PaginationService $paginationService, $page): Response {

		$nbElements = 8;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * 8);
		}

		$elements = $this->getDoctrine()->getRepository(Hours::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$hours = $this->getDoctrine()->getRepository(Hours::class)->findBy([], ['hour' => 'ASC'], $nbElements, $offset);

		return $this->renderForm('admin/agenda/agenda_hours.html.twig', [
				'hours'           => $hours,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	#[Route('/agenda/gerer-les-horaires/ajouter/', name: 'admin_agenda_hours_add', methods: ['GET', 'POST'])]
	public function agenda_horaires_add(Request $request): Response {
		$hour = new Hours();
		$form = $this->createForm(HoursType::class, $hour);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($hour);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_hours_add', [], Response::HTTP_SEE_OTHER);
		}

		$hours = $this->getDoctrine()->getRepository(Hours::class)->findBy([], ['id' => 'DESC']);

		return $this->renderForm('admin/agenda/agenda_hours_add.html.twig', [
				'hour'  => $hour,
				'form'  => $form,
				'hours' => $hours,
		]);
	}

	#[Route('/agenda/gerer-les-horaires/modifier-{id}/', name: 'admin_agenda_hours_modify', methods: ['GET', 'POST'])]
	public function agenda_horaires_modify(Request $request, $id, AdminService $adminService): Response {
		$hour = $this->getDoctrine()->getRepository(Hours::class)->find($id);

		$form = $this->createForm(HoursType::class, $hour);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($hour);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_hours', [
					'page' => '1',
			],                            Response::HTTP_SEE_OTHER);
		}

		$hours = $this->getDoctrine()->getRepository(Hours::class)->findBy([], ['id' => 'DESC']);

		return $this->renderForm('admin/agenda/agenda_hours_add.html.twig', [
				'hour'  => $hour,
				'form'  => $form,
				'hours' => $hours,
		]);
	}

	#[Route('/agenda/gerer-les-horaires/delete-{id}/', name: 'admin_agenda_hours_delete', methods: ['POST'])]
	public function agenda_horaires_delete(Request $request, Hours $hour): Response {
		if ($this->isCsrfTokenValid('delete' . $hour->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($hour);
			$entityManager->flush();
		}

		return $this->redirectToRoute('admin_agenda_hours', [
				'page' => '1',
		],                            Response::HTTP_SEE_OTHER);
	}




	// CRUD DUREE

	#[Route('/agenda/gerer-les-durees-{page}/', name: 'admin_agenda_durations', methods: ['GET', 'POST'])]
	public function agenda_durees(Request $request, PaginationService $paginationService, $page): Response {

		$nbElements = 8;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * 8);
		}

		$elements = $this->getDoctrine()->getRepository(Duration::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$durations = $this->getDoctrine()->getRepository(Duration::class)->findBy([], ['duration' => 'ASC'], $nbElements, $offset);

		return $this->renderForm('admin/agenda/agenda_durations.html.twig', [
				'durations'       => $durations,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	#[Route('/agenda/gerer-les-durees/ajouter/', name: 'admin_agenda_durations_add', methods: ['GET', 'POST'])]
	public function agenda_durees_add(Request $request, AdminService $adminService): Response {
		$duration = new Duration();
		$form = $this->createForm(DurationType::class, $duration);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$toSlug = $form->get('title')->getData();
			$slug = $adminService->slugify($toSlug);

			$duration->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($duration);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_durations_add', [], Response::HTTP_SEE_OTHER);
		}

		$durations = $this->getDoctrine()->getRepository(Duration::class)->findBy([], ['duration' => 'ASC']);

		return $this->renderForm('admin/agenda/agenda_durations_add.html.twig', [
				'duration'  => $duration,
				'form'      => $form,
				'durations' => $durations,
		]);
	}


	#[Route('/agenda/gerer-les-durees/modifier-{id}/', name: 'admin_agenda_durations_modify', methods: ['GET', 'POST'])]
	public function agenda_durees_modify(Request $request, $id, AdminService $adminService): Response {
		$duration = $this->getDoctrine()->getRepository(Duration::class)->find($id);

		$form = $this->createForm(DurationType::class, $duration);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$toSlug = $form->get('title')->getData();
			$slug = $adminService->slugify($toSlug);

			$duration->setSlug($slug);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($duration);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_durations', [
					'page' => '1',
			],                            Response::HTTP_SEE_OTHER);
		}

		$durations = $this->getDoctrine()->getRepository(Duration::class)->findBy([], ['duration' => 'ASC']);

		return $this->renderForm('admin/agenda/agenda_durations_add.html.twig', [
				'duration'  => $duration,
				'form'      => $form,
				'durations' => $durations,
		]);
	}

	#[Route('/agenda/gerer-les-durees/delete-{id}/', name: 'admin_agenda_durations_delete', methods: ['POST'])]
	public function agenda_durees_delete(Request $request, Duration $duration): Response {
		if ($this->isCsrfTokenValid('delete' . $duration->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($duration);
			$entityManager->flush();
		}

		return $this->redirectToRoute('admin_agenda_durations', [
				'page' => '1',
		],                            Response::HTTP_SEE_OTHER);
	}




	// CRUD DATES INDISPONIBLES

	#[Route('/agenda/gerer-les-dates-indisponibles-{page}/', name: 'admin_agenda_unavailable', methods: ['GET', 'POST'])]
	public function agenda_unavailable(Request $request, PaginationService $paginationService, $page): Response {

		$nbElements = 8;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * 8);
		}

		$elements = $this->getDoctrine()->getRepository(Unavailable::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$unavailables = $this->getDoctrine()->getRepository(Unavailable::class)->findBy([], ['date' => 'ASC'], $nbElements, $offset);

		return $this->renderForm('admin/agenda/agenda_unavailable.html.twig', [
				'unavailables'    => $unavailables,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	#[Route('/agenda/gerer-les-dates-indisponibles/ajouter/', name: 'admin_agenda_unavailable_add', methods: ['GET', 'POST'])]
	public function agenda_unavailable_add(Request $request): Response {
		$unavailable = new Unavailable();
		$form = $this->createForm(UnavailableType::class, $unavailable);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($unavailable);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_unavailable_add', [], Response::HTTP_SEE_OTHER);
		}

		$unavailables = $this->getDoctrine()->getRepository(Unavailable::class)->findBy([], ['date' => 'ASC']);

		return $this->renderForm('admin/agenda/agenda_unavailable_add.html.twig', [
				'unavailable'  => $unavailable,
				'form'         => $form,
				'unavailables' => $unavailables,
		]);
	}


	#[Route('/agenda/gerer-les-dates-indisponibles/modifier-{id}/', name: 'admin_agenda_unavailable_modify', methods: ['GET', 'POST'])]
	public function agenda_unavailable_modify(Request $request, $id): Response {
		$unavailable = $this->getDoctrine()->getRepository(Unavailable::class)->find($id);

		$form = $this->createForm(UnavailableType::class, $unavailable);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($unavailable);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_unavailable', [
					'page' => '1',
			],                            Response::HTTP_SEE_OTHER);
		}

		$unavailables = $this->getDoctrine()->getRepository(Unavailable::class)->findBy([], ['date' => 'ASC']);

		return $this->renderForm('admin/agenda/agenda_unavailable_add.html.twig', [
				'unavailable'  => $unavailable,
				'form'         => $form,
				'unavailables' => $unavailables,
		]);
	}

	#[Route('/agenda/gerer-les-dates-indisponibles/delete-{id}', name: 'admin_agenda_unavailable_delete', methods: ['POST'])]
	public function agenda_unavailable_delete(Request $request, Unavailable $unavailable): Response {
		if ($this->isCsrfTokenValid('delete' . $unavailable->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($unavailable);
			$entityManager->flush();
		}

		return $this->redirectToRoute('admin_agenda_unavailable', [
				'page' => '1',
		],                            Response::HTTP_SEE_OTHER);
	}




	// CRUD DES DELAIS DE RENDEZ-VOUS

	#[Route('/agenda/gerer-les-delais-de-rendez-vous-{page}/', name: 'admin_agenda_distance', methods: ['GET', 'POST'])]
	public function agenda_delais(Request $request, PaginationService $paginationService, $page): Response {

		$nbElements = 8;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * 8);
		}

		$elements = $this->getDoctrine()->getRepository(Distance::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$distances = $this->getDoctrine()->getRepository(Distance::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->renderForm('admin/agenda/agenda_distance.html.twig', [
				'distances'        => $distances,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	#[Route('/agenda/gerer-les-delais-de-rendez-vous/ajouter/', name: 'admin_agenda_distance_add', methods: ['GET', 'POST'])]
	public function agenda_distance_add(Request $request): Response {
		$distance = new Distance();
		$form = $this->createForm(DistanceType::class, $distance);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($distance);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_distance_add', [], Response::HTTP_SEE_OTHER);
		}

		$distances = $this->getDoctrine()->getRepository(Distance::class)->findBy([], ['id' => 'ASC']);

		return $this->renderForm('admin/agenda/agenda_distance_add.html.twig', [
				'distance'  => $distance,
				'form'      => $form,
				'distances' => $distances,
		]);
	}

	#[Route('/agenda/gerer-les-delais-de-rendez-vous/modifier-{id}/', name: 'admin_agenda_distance_modify', methods: ['GET', 'POST'])]
	public function agenda_delais_modify(Request $request, $id): Response {
		$distance = $this->getDoctrine()->getRepository(Distance::class)->find($id);

		$form = $this->createForm(DistanceType::class, $distance);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($distance);
			$entityManager->flush();

			return $this->redirectToRoute('admin_agenda_distance', [
					'page' => '1',
			],                            Response::HTTP_SEE_OTHER);
		}

		$distances = $this->getDoctrine()->getRepository(Distance::class)->findBy([], ['id' => 'DESC']);

		return $this->renderForm('admin/agenda/agenda_distance_add.html.twig', [
				'distance'  => $distance,
				'form'   => $form,
				'distances' => $distances,
		]);
	}

	#[Route('/agenda/gerer-les-delais-de-rendez-vous/delete-{id}/', name: 'admin_agenda_distance_delete', methods: ['POST'])]
	public function agenda_delais_delete(Request $request, Distance $distance): Response {
		if ($this->isCsrfTokenValid('delete' . $distance->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($distance);
			$entityManager->flush();
		}

		return $this->redirectToRoute('admin_agenda_distance', [
				'page' => '1',
		],                            Response::HTTP_SEE_OTHER);
	}

}
