<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Days;
use App\Entity\DiscountTicket;
use App\Entity\Distance;
use App\Entity\Duration;
use App\Entity\FreeShipping;
use App\Entity\HomeContent;
use App\Entity\Hours;
use App\Entity\Orders;
use App\Entity\PaymentMethod;
use App\Entity\Rendezvous;
use App\Entity\Services;
use App\Entity\ProductCategory;
use App\Entity\Product;
use App\Entity\ProductSubcategory;
use App\Entity\ShippingCost;
use App\Entity\SpecialOffer;
use App\Entity\Tva;
use App\Entity\Unavailable;
use App\Form\HomeContentType;
use App\Form\ProductFormType;
use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController {

	// Accueil de l'admin //
	#[Route('/admin/', name: 'admin')]
	public function index(): Response {
		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], 3);

		return $this->render('admin/index.html.twig', [
				'products' => $products,
		]);
	}


	// Gestion du contenu du site : textes, img... //
	#[Route('/admin/contenu/', name: 'admin_content')]
	public function contenu(Request $request): Response {

		$content = $this->getDoctrine()->getRepository(HomeContent::class)->find(1);

		$form = $this->createForm(HomeContentType::class, $content);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($content);
			$entityManager->flush();

			$this->addFlash("success", 'Le contenu a été modifié avec succès');

			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/contenu.html.twig', [
				'form' => $form->createView(),
		]);
	}


	#[Route('/admin/contenu/ajouter/', name: 'admin_content_add')]
	public function contenu_add(Request $request): Response {

		$content = new HomeContent();

		$form = $this->createForm(HomeContentType::class, $content);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($content);
			$entityManager->flush();

			$this->addFlash("success", 'Le contenu a été modifié avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/contenu.html.twig', [
				'form' => $form->createView(),
		]);
	}


	// Gestion des catégories de produits //
	#[Route('/admin/categories-{page}/', name: 'admin_categories')]
	public function categories($page, PaginationService $paginationService): Response {
		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(ProductCategory::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/categories.html.twig', [
				'categories'      => $categories,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}


	// Gestion des sous-catégories de produits //
	#[Route('/admin/sous-categories-{page}/', name: 'admin_subcategories')]
	public function subcategories($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/subcategories.html.twig', [
				'subcategories'   => $subcategories,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}


	// Gestion des produits //
	#[Route('/admin/produits-{page}/', name: 'admin_products')]
	public function produits($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Product::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/produits.html.twig', [
				'products'        => $products,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	// Gestion des services proposés //
	#[Route('/admin/services-{page}/', name: 'admin_services')]
	public function services($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Services::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$services = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/services.html.twig', [
				'services'        => $services,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}


	// Gestion des produits //
	#[Route('/admin/tva/', name: 'admin_tva')]
	public function tva(): Response {
		$tvas = $this->getDoctrine()->getRepository(Tva::class)->findBy([], ['id' => 'DESC']);

		return $this->render('admin/tva.html.twig', [
				'tvas' => $tvas,
		]);
	}


	// Gestion des frais de ports //
	#[Route('/admin/frais-de-ports-{page}/', name: 'admin_shipping')]
	public function ports($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(ShippingCost::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$shippings = $this->getDoctrine()->getRepository(ShippingCost::class)->findBy([], ['min' => 'ASC'], $nbElements, $offset);

		$freeShipping = $this->getDoctrine()->getRepository(FreeShipping::class)->find(1);

		return $this->render('admin/shipping.html.twig', [
				'shippings'       => $shippings,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
				'freeShipping'    => $freeShipping,
		]);
	}


	// Gestion des promotions //
	#[Route('/admin/promotions-{page}/', name: 'admin_special_offers')]
	public function specialOffers($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(SpecialOffer::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$offers = $this->getDoctrine()->getRepository(SpecialOffer::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/special_offers.html.twig', [
				'offers'          => $offers,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	// Gestion des bons de réductions //
	#[Route('/admin/bons-de-reductions-{page}/', name: 'admin_discount_ticket')]
	public function discountTicket($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(DiscountTicket::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$tickets = $this->getDoctrine()->getRepository(DiscountTicket::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/discount_ticket.html.twig', [
				'tickets'         => $tickets,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}


	// Gestion des clients //
	#[Route('/admin/clients-{page}/', name: 'admin_customers')]
	public function clients($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Customer::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$customers = $this->getDoctrine()->getRepository(Customer::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/clients.html.twig', [
				'customers'       => $customers,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}


	// Gestion des commandes //
	#[Route('/admin/commandes-{page}/', name: 'admin_orders')]
	public function commandes($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Orders::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$orders = $this->getDoctrine()->getRepository(Orders::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/commandes.html.twig', [
				'orders'          => $orders,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}

	// Gestion des commandes //
	#[Route('/admin/moyens-de-paiement-{page}/', name: 'admin_payment_methods')]
	public function paymentMethods($page, PaginationService $paginationService): Response {

		$nbElements = 7;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(PaymentMethod::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$methods = $this->getDoctrine()->getRepository(PaymentMethod::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

		return $this->render('admin/payment_methods.html.twig', [
				'methods'         => $methods,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
		]);
	}


	// Gestion des newsletter //
	#[Route('/admin/newsletter/', name: 'admin_newsletter')]
	public function newsletter(): Response {
		return $this->render('admin/newsletter.html.twig', [
				'controller_name' => 'AdminController',
		]);
	}


	// Gestion des rendez-vous //
	#[Route('/admin/rendez-vous/', name: 'admin_appointment')]
	public function rdv(): Response {

		$days = $this->getDoctrine()->getRepository(Days::class)->findBy([], ['name' => 'ASC'], 7);
		$rdvs = $this->getDoctrine()->getRepository(Rendezvous::class)->findBy([], ['date' => 'DESC'], 7);
		$hours = $this->getDoctrine()->getRepository(Hours::class)->findBy([], ['hour' => 'ASC'], 7);
		$unavailables = $this->getDoctrine()->getRepository(Unavailable::class)->findBy([], ['date' => 'DESC'], 3);
		$durations = $this->getDoctrine()->getRepository(Duration::class)->findBy([], ['duration' => 'ASC'], 3);
		$distances = $this->getDoctrine()->getRepository(Distance::class)->findBy([], ['title' => 'ASC'], 3);

		return $this->render('admin/rdv.html.twig', [
				'days'         => $days,
				'rdvs'         => $rdvs,
				'hours'        => $hours,
				'unavailables' => $unavailables,
				'durations'    => $durations,
				'distances'    => $distances,
		]);
	}


	// Gestion des utilisateurs //
	#[Route('/admin/utilisateurs/', name: 'admin_users')]
	public function utilisateurs(): Response {
		return $this->render('admin/utilisateurs.html.twig', [
				'controller_name' => 'AdminController',
		]);
	}


	// Gestion des thèmes //
	#[Route('/admin/themes/', name: 'admin_design')]
	public function themes(): Response {
		return $this->render('admin/themes.html.twig', [
				'controller_name' => 'AdminController',
		]);
	}


	// Gestion des droits //
	#[Route('/admin/droits/', name: 'admin_rights')]
	public function droits(): Response {
		return $this->render('admin/droits.html.twig', [
				'controller_name' => 'AdminController',
		]);
	}


	// Gestion des modules //
	#[Route('/admin/modules/', name: 'admin_modules')]
	public function modules(): Response {
		return $this->render('admin/modules.html.twig', [
				'controller_name' => 'AdminController',
		]);
	}

}
