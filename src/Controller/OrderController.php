<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Orders;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OrderController extends AbstractController {

	#[Route('/panier/commande/', name: 'order')]
	public function index(): Response {

		return $this->render('order/index.html.twig', [

		]);
	}

	#[Route('/panier/commande/recapitulatif-{orderNumber}/', name: 'order_details')]
	public function details(Request $request, $orderNumber): Response {

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber]);
		$user = $this->getUser();

		// TODO: Initiliaze variables as empty strings and replace their value if user is connected

		$name = '';
		$firstname = '';
		$email = '';
		$phone = '';
		$delivery_adress = '';
		$delivery_building = '';
		$delivery_apartment = '';
		$delivery_zipcode = '';
		$delivery_city = '';
		$delivery_country = '';

		if($user) {
			$customerId = $order->getUser();

			$customer = $this->getDoctrine()->getRepository(Customer::class)->find($customerId);

			$name = $user->getName();
			$firstname = $user->getFirstName();
			$email = $customer->getEmail();
			$phone = $customer->getPhone();
			$delivery_adress = $customer->getStreetNb() . ' ' . $customer->getStreetName() . ' ' . $customer->getStreetName2();
			$delivery_building = $customer->getBuilding();
			$delivery_apartment = $customer->getApartment();
			$delivery_zipcode = $customer->getZipcode();
			$delivery_city = $customer->getCity();
			$delivery_country = $customer->getCountry();
		}


		$form = $this->createFormBuilder()
				->add('name', TextType::class, [
						'label' => 'Nom *',
						'attr'  => [
								'placeholder' => 'Nom du destinataire',
								'value'       => $name,
						],
				])
				->add('firstname', TextType::class, [
						'label' => 'Prénom *',
						'attr'  => [
								'placeholder' => 'Prénom du destinataire',
								'value'       => $firstname,
						],
				])
				->add('email', EmailType::class, [
						'label' => 'Email *',
						'attr'  => [
								'placeholder' => 'Email du destinataire',
								'value'       => $email,
						],
				])
				->add('phone', TelType::class, [
						'label' => 'Numéro de téléphone *',
						'attr'  => [
								'placeholder' => 'Téléphone du destinataire',
								'value'       => $phone,
						],
				])
				->add('delivery_adress', TextareaType::class, [
						'label' => 'Adresse de livraison *',
						'attr'  => [
								'placeholder' => 'N° et nom de la rue du destinataire',
								'value'       => $delivery_adress,
						],
				])
				->add('delivery_building', TextType::class, [
						'label'    => 'Bâtiment de livraison',
						'attr'     =>
								[
										'placeholder' => 'Bâtiment',
										'value'       => $delivery_building,
								],
						'required' => false,
				])
				->add('delivery_apartment', TextType::class, [
						'label'    => "N° d'appartement de livraison",
						'attr'     =>
								[
										'placeholder' => "n° d'appartement",
										'value'       => $delivery_apartment,
								],
						'required' => false,
				])
				->add('delivery_zipcode', TextType::class, [
						'label' => 'Code postal de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Code postal',
										'value'       => $delivery_zipcode,
								],
				])
				->add('delivery_city', TextType::class, [
						'label' => 'Ville de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Ville',
										'value'       => $delivery_city,
								],
				])
				->add('delivery_country', CountryType::class, [
						'label' => 'Pays de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Pays',
										'value'       => $delivery_country,
								],
				])
				/* Facturation */

				->add('invoicing_name', TextType::class, [
						'label' => 'Nom *',
						'attr'  => [
								'placeholder' => 'Nom du destinataire',
						],

				])
				->add('invoicing_firstname', TextType::class, [
						'label' => 'Prénom *',
						'attr'  => [
								'placeholder' => 'Prénom du destinataire',
						],

				])
				->add('invoicing_email', EmailType::class, [
						'label' => 'Email *',
						'attr'  => [
								'placeholder' => 'Email du destinataire',
						],

				])
				->add('invoicing_phone', TelType::class, [
						'label' => 'Numéro de téléphone *',
						'attr'  => [
								'placeholder' => 'Téléphone du destinataire',
						],

				])
				->add('invoicing_adress', TextareaType::class, [
						'label' => 'Adresse de facturation *',
						'attr'  => [
								'placeholder' => 'N° et nom de la rue pour la facture',
						],
				])
				->add('invoicing_building', TextType::class, [
						'label'    => 'Bâtiment de facturation',
						'attr'     =>
								[
										'placeholder' => 'Bâtiment',
								],
						'required' => false,
				])
				->add('invoicing_apartment', TextType::class, [
						'label'    => "N° d'appartement de facturation",
						'attr'     =>
								[
										'placeholder' => "n° d'appartement",
								],
						'required' => false,
				])
				->add('invoicing_zipcode', TextType::class, [
						'label' => 'Code postal de facturation *',
						'attr'  =>
								[
										'placeholder' => 'Code postal',
								],
				])
				->add('invoicing_city', TextType::class, [
						'label' => 'Ville de facturation *',
						'attr'  =>
								[
										'placeholder' => 'Ville',
								],
				])
				->add('invoicing_country', CountryType::class, [
						'label' => 'Pays de facturation *',
						'attr'  =>
								[
										'placeholder' => 'Pays',
								],
				])
				->getForm();

		$form->handleRequest($request);

		return $this->render('order/details.html.twig', [
				'form' => $form->createView(),
		]);
	}

	#[Route('/panier/commande/choisissez-votre-methode-de-paiement/', name: 'order_method_choice')]
	public function method(): Response {

		return $this->render('order/choice.html.twig', [

		]);
	}

	#[Route('/panier/commande/paiement-par-carte/', name: 'order_payment_stripe')]
	public function stripe(): Response {

		return $this->render('order/stripe.html.twig', [

		]);
	}

	#[Route('/panier/commande/paiement-par-carte/checkout/', name: 'order_payment_stripe_checkout')]
	public function checkout($stripeSK): Response {

		Stripe::setApiKey($stripeSK);

		$session = Session::create([
				                           'line_items'  => [[
						                           'price_data' => [
								                           'currency'     => 'eur',
								                           'product_data' => [
										                           'name' => 'T-shirt',
								                           ],
								                           'unit_amount'  => 2000,
						                           ],
						                           'quantity'   => 1,
				                           ]],
				                           'mode'        => 'payment',
				                           'success_url' => $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
				                           'cancel_url'  => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
		                           ]);

		return $this->redirect($session->url, 303);
	}

	#[Route('/panier/stripe/success/', name: 'success_url')]
	public function success(): Response {

		return $this->render('payment/success.html.twig', [

		]);
	}

	#[Route('/panier/stripe/cancel/', name: 'cancel_url')]
	public function cancel(): Response {

		return $this->render('payment/cancel.html.twig', [

		]);
	}


}
