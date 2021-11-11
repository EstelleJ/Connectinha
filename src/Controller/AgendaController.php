<?php

namespace App\Controller;

use App\Entity\Days;
use App\Entity\Hours;
use App\Entity\Rendezvous;
use App\Entity\Services;
use App\Entity\Unavailable;
use App\Service\ToolsService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendaController extends AbstractController {

	#[Route('/programmer-un-rendez-vous/', name: 'agenda')]
	public function index(): Response {

		$services = $this->getDoctrine()->getRepository(Services::class)->findAll();

		return $this->render('agenda/index.html.twig', [
				'services' => $services,
		]);
	}


	#[Route('/programmer-un-rendez-vous/choisissez-votre-heure/', name: 'agenda_hours')]
	public function hours(Request $request, ToolsService $tools): Response {

		$client_date = $request->request->get('date');
		$service_id = intval($request->request->get('service-id'));
		$rdv_weekday = '';
		$displayed_hours = [];

		$error = '';

		$service = $this->getDoctrine()->getRepository(Services::class)->find($service_id);

		// ========================================================================
		// Date
		// ========================================================================
		if ($client_date) {
			$date = date_create_from_format('d/m/Y', $client_date);
			$rendezvouses = $this->getDoctrine()->getRepository(Rendezvous::class)->findBy(['date' => $date]);
			$taken_rdv = [];
			foreach ($rendezvouses as $rendezvous) {
				array_push($taken_rdv, date('Y-m-d', $date->getTimestamp()) . ' ' . $rendezvous->getHours());
			}
			$rdv_weekday = date('l', $date->getTimestamp());
			$rdv_weekday = $tools->translateWeekday($rdv_weekday);
			$weekday = $this->getDoctrine()->getRepository(Days::class)->findOneBy(['slug' => $rdv_weekday]);
			$hours = $weekday->getHours();

			$available_hours = [];
			foreach ($hours as $hour) {
				// Only add horaires to available horaires if the duree matches the one from the prestation
				if ($hour->getDuration()->getServices()->contains($service)) {
					array_push($available_hours, date('Y-m-d', $date->getTimestamp()) . ' ' . $hour);
				}
			}

			$hours_left = $available_hours; // array containing the dates and horaires left available for the day
			foreach ($available_hours as $hour) {
				if (in_array($hour, $taken_rdv)) {
					array_splice($hours_left, array_search($hour, $hours_left), 1);
				}
			}

			foreach ($hours_left as $hour) {
				array_push($displayed_hours, substr($hour, 10));
			}
		}

		// ========================================================================
		// Form
		// ========================================================================
		$duration = $service->getDuration();

		$rendezvous = new Rendezvous();
		$rendezvous->setDuration($duration);
		$rendezvous->setDay($weekday);
		$rendezvous->setService($service);
		$rendezvous->setDate($date);

		$form = $this->createFormBuilder($rendezvous)
				->add('name', TextType::class, [
						'label' => 'Nom',
				])
				->add('firstname', TextType::class, [
						'label' => 'Prénom',
				])
				->add('email', EmailType::class, [
						'label' => 'Adresse Email',
				])
				->add('phoneNumber', TelType::class, [
						'label' => 'Numéro de téléphone',
				])
				->getForm();

		$form->handleRequest($request);


		if ($form->isSubmitted() && $form->isValid()) {

			$rendezvous->setName($form->get('name')->getData());
			$rendezvous->setFirstname($form->get('firstname')->getData());
			$rendezvous->setEmail($form->get('email')->getData());
			$rendezvous->setPhoneNumber($form->get('phoneNumber')->getData());
			$rendezvous->setToken(uniqid('t', true));

			$hour_string = $request->request->get('hour');
			$hour_string = substr($hour_string, 0, 5);

			$hour = $this->getDoctrine()->getRepository(Hours::class)
					->findOneBy([
							            'hour'     => new DateTime($hour_string),
							            'duration' => $duration,
					            ]);
			$rendezvous->setHours($hour);

			$duplicate_rendezvous = $this->getDoctrine()->getRepository(Rendezvous::class)
					->findBy([
							         'duration' => $rendezvous->getDuration(),
							         'date'     => $rendezvous->getDate(),
							         'hours'    => $rendezvous->getHours(),
					         ]);

			if (empty($duplicate_rendezvous)) {
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($rendezvous);
				$entityManager->flush();

				return $this->redirectToRoute('agenda_confirm', [
						'token' => $rendezvous->getToken(),
				]);
			}
			else {
				$error = "Malheureusement, ce rendez-vous n'est plus disponible.";
			}

		}

		return $this->render('agenda/heure.html.twig', [
				'date'      => $client_date,
				'serviceId' => $service_id,
				'day'       => $rdv_weekday,
				'hours'     => $displayed_hours,
				'form'      => $form->createView(),
				'error'     => $error,
		]);
	}


	#[Route('/programmer-un-rendez-vous/confirmation-{token}/', name: 'agenda_confirm')]
	public function confirm(Request $request, $token): Response {

		$rendezvous = $this->getDoctrine()->getRepository(Rendezvous::class)->findOneBy([
				                                                                                'token' => $token,
		                                                                                ]);
		return $this->render('agenda/confirmation.html.twig', [
				'rendezvous' => $rendezvous,
		]);
	}


	#[Route('/programmer-un-rendez-vous/prestation-{serviceId}/', name: 'agenda_days')]
	public function days(int $serviceId, ToolsService $tools): Response {

		$service = $this->getDoctrine()->getRepository(Services::class)->find($serviceId);

		// Get disabled weekdays by taking out available weekdays
		$available_weekdays = $this->getDoctrine()->getRepository(Days::class)->findAll();
		$disabled_weekdays = [0, 1, 2, 3, 4, 5, 6];
		foreach ($available_weekdays as $weekday) {
			// Disable weekdays with rdv not corresponding to the prestation
			$hours = $weekday->getHours();
			$hours_left = $hours;
			foreach ($hours as $hour) {
				if ($hour->getDuration() !== $service->getDuration()) {
					$hours_left->removeElement($hour);
				}
			}
			// if no horaires, the day stay disabled
			if (!$weekday->getHours()->isEmpty() || !$hours_left->isEmpty()) {
				switch ($weekday->getSlug()) {
					case 'lundi':
						array_splice($disabled_weekdays, array_search(1, $disabled_weekdays), 1);
						break;
					case 'mardi':
						array_splice($disabled_weekdays, array_search(2, $disabled_weekdays), 1);
						break;
					case 'mercredi':
						array_splice($disabled_weekdays, array_search(3, $disabled_weekdays), 1);
						break;
					case 'jeudi':
						array_splice($disabled_weekdays, array_search(4, $disabled_weekdays), 1);
						break;
					case 'vendredi':
						array_splice($disabled_weekdays, array_search(5, $disabled_weekdays), 1);
						break;
					case 'samedi':
						array_splice($disabled_weekdays, array_search(6, $disabled_weekdays), 1);
						break;
					case 'dimanche':
						array_splice($disabled_weekdays, array_search(0, $disabled_weekdays), 1);
						break;
					default:
						break;
				}
			}
		}


		// Get max date from prestation's DistanceRDV
		$distance = $service->getDistance();
		$max_date = date('Y-m-d', strtotime('+' . $distance->getDuration() . ' ' . $distance->getUnity()));


		// Get disabled dates from Indisponibles
		$unavailable_dates = $this->getDoctrine()->getRepository(Unavailable::class)->findAll();
		$disabled_dates = [];
		$today = date_create();
		foreach ($unavailable_dates as $date) {
			$i = 0;
			while (date_create((int)$today->format('Y') + $i . $date->getDateStringWithoutYear()) < date_create($max_date)) {
				array_push($disabled_dates, (int)$today->format('Y') + $i . $date->getDateStringWithoutYear());
				$i++;
			}
		}

		// Get coming rendezvouses
		$rendezvouses = $this->getDoctrine()->getRepository(Rendezvous::class)->findComing();
		$dates = []; // Dates of all days with taken rdv
		$all_taken_rdv = []; // array containing the date and horaire of all taken rdv
		foreach ($rendezvouses as $rendezvous) {
			if (!in_array($rendezvous->getDate(), $dates)) {
				array_push($dates, $rendezvous->getDate());
			}
			array_push($all_taken_rdv, date('Y-m-d', $rendezvous->getDate()->getTimestamp()) . ' ' . $rendezvous->getHours());
		}
		foreach ($dates as $date) {
			$available_hours = []; // array containing the date and horaire of the day
			$rdv_weekday = date('l', $date->getTimestamp());
			$rdv_weekday = $tools->translateWeekday($rdv_weekday);
			$weekday = $this->getDoctrine()->getRepository(Days::class)->findOneBy(['slug' => $rdv_weekday]);
			$hours = $weekday->getHours();
			foreach ($hours as $hour) {
				// Only add horaires to available horaires if the duree matches the one from the prestation
				if ($hour->getDuration()->getServices()->contains($service)) {
					array_push($available_hours, date('Y-m-d', $date->getTimestamp()) . ' ' . $hour);
				}
			}
			$hours_left = $available_hours; // array containing the dates and horaires left available for the day
			foreach ($available_hours as $hour) {
				if (in_array($hour, $all_taken_rdv)) {
					array_splice($hours_left, array_search($hour, $hours_left), 1);
				}
			}
			// Add the day to disbaled dates if no horaires are left
			if (empty($hours_left)) {
				array_push($disabled_dates, date('Y-m-d', $date->getTimestamp()));
			}
		}


		return $this->render('agenda/jours.html.twig', [
				'disabled_dates'    => json_encode($disabled_dates),
				'disabled_weekdays' => json_encode($disabled_weekdays),
				'max_date'          => $max_date,
				'service_id'        => $serviceId,
		]);
	}
}
