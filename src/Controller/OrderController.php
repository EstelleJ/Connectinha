<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Orders;
use App\Entity\PaymentMethod;
use App\Service\MailJetService;
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

		if ($user) {
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
						'label'    => 'Nom *',
						'attr'     => [
								'placeholder' => 'Nom du destinataire',
								'value'       => $name,
						],
						'required' => true,
				])
				->add('firstname', TextType::class, [
						'label'    => 'Prénom *',
						'attr'     => [
								'placeholder' => 'Prénom du destinataire',
								'value'       => $firstname,
						],
						'required' => true,
				])
				->add('email', EmailType::class, [
						'label'    => 'Email *',
						'attr'     => [
								'placeholder' => 'Email du destinataire',
								'value'       => $email,
						],
						'required' => true,
				])
				->add('phone', TelType::class, [
						'label'    => 'Numéro de téléphone *',
						'attr'     => [
								'placeholder' => 'Téléphone du destinataire',
								'value'       => $phone,
						],
						'required' => true,
				])
				->add('delivery_adress', TextareaType::class, [
						'label'    => 'Adresse de livraison *',
						'attr'     => [
								'placeholder' => $delivery_adress,
								'value'       => $delivery_adress,
						],
						'required' => true,
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
						'label'    => 'Code postal de livraison *',
						'attr'     =>
								[
										'placeholder' => 'Code postal',
										'value'       => $delivery_zipcode,
								],
						'required' => true,
				])
				->add('delivery_city', TextType::class, [
						'label'    => 'Ville de livraison *',
						'attr'     =>
								[
										'placeholder' => 'Ville',
										'value'       => $delivery_city,
								],
						'required' => true,
				])
				->add('delivery_country', CountryType::class, [
						'label'             => 'Pays de livraison *',
						'attr'              =>
								[
										'placeholder' => 'Pays',
										'value'       => $delivery_country,
								],
						'preferred_choices' => [$delivery_country],
						'required'          => true,
				])
				/* Facturation */

				->add('invoicing_name', TextType::class, [
						'label'    => 'Nom *',
						'attr'     => [
								'placeholder' => 'Nom du destinataire',
						],
						'required' => true,

				])
				->add('invoicing_firstname', TextType::class, [
						'label'    => 'Prénom *',
						'attr'     => [
								'placeholder' => 'Prénom du destinataire',
						],
						'required' => true,

				])
				->add('invoicing_email', EmailType::class, [
						'label'    => 'Email *',
						'attr'     => [
								'placeholder' => 'Email du destinataire',
						],
						'required' => true,

				])
				->add('invoicing_phone', TelType::class, [
						'label'    => 'Numéro de téléphone *',
						'attr'     => [
								'placeholder' => 'Téléphone du destinataire',
						],
						'required' => true,

				])
				->add('invoicing_adress', TextareaType::class, [
						'label'    => 'Adresse de facturation *',
						'attr'     => [
								'placeholder' => $delivery_adress,
						],
						'required' => true,
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
						'label'    => 'Code postal de facturation *',
						'attr'     =>
								[
										'placeholder' => 'Code postal',
								],
						'required' => true,
				])
				->add('invoicing_city', TextType::class, [
						'label'    => 'Ville de facturation *',
						'attr'     =>
								[
										'placeholder' => 'Ville',
								],
						'required' => true,
				])
				->add('invoicing_country', CountryType::class, [
						'label'    => 'Pays de facturation *',
						'attr'     =>
								[
										'placeholder' => 'Pays',
								],
						'required' => true,
				])
				->getForm();

		$form->handleRequest($request);

		return $this->render('order/details.html.twig', [
				'form' => $form->createView(),
		]);
	}

	#[Route('/panier/commande/choisissez-votre-methode-de-paiement-{orderNumber}/', name: 'order_method_choice')]
	public function method($orderNumber): Response {

		$method = $this->getDoctrine()->getRepository(PaymentMethod::class)->findOneBy(['slug' => 'paiement-par-carte']);

		return $this->render('order/choice.html.twig', [
				'method'      => $method,
				'orderNumber' => $orderNumber,
		]);
	}


	#[Route('/panier/commande/paiement-par-carte-{orderNumber}-{id}/', name: 'order_payment_stripe', requirements: ['orderNumber' => '[a-zA-Z0-9\-_]+'])]
	public function stripePayment($orderNumber, $id): Response {

		$method = $this->getDoctrine()->getRepository(PaymentMethod::class)->find($id);
		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber]);

		return $this->redirectToRoute('order_payment_stripe_checkout', [
				'orderNumber' => $orderNumber,
		]);

		// return $this->render('order/stripe.html.twig', [
		// 		'orderNumber' => $orderNumber,
		// ]);
	}

	#[Route('/panier/commande/reglement-sur-place-{orderNumber}-{id}/', name: 'order_money_payment', requirements: ['orderNumber' => '[a-zA-Z0-9\-_]+'])]
	public function moneyPayment($orderNumber, $id): Response {

		$method = $this->getDoctrine()->getRepository(PaymentMethod::class)->find($id);

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber]);

		$order->setStatus('Enregistrée - Règlement sur place');

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($order);
		$entityManager->flush();

		return $this->render('order/money.html.twig', [

		]);
	}

	#[Route('/panier/commande/paiement-par-carte/checkout-{orderNumber}/', name: 'order_payment_stripe_checkout')]
	public function checkout($stripeSK, $orderNumber): Response {

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber]);

		$price = $order->getPrice() * 100;

		$array_products = $order->getProductArray();
		$json_cart = implode(",", $array_products);
		$saved_products = json_decode($json_cart);

		$items = [];

		foreach ($saved_products as $product) {

			if ($product->discount == null) {
				$discount = 0;
			}
			else {
				$discount = $product->discount;
			}

			$unitPrice = ($product->price - ($product->price * (int)$discount / 100)) * 100;

			$array = [
					'price_data' => [
							'currency'     => 'eur',
							'product_data' => [
									'name' => $product->title,
							],
							'unit_amount'  => $unitPrice,
					],
					'quantity'   => $product->quantity,
			];

			array_push($items, $array);
		}

		$shippingCost = [
				'price_data' => [
						'currency'     => 'eur',
						'product_data' => [
								'name' => 'Frais de livraison',
						],
						'unit_amount'  => $order->getShippingCost() * 100,
				],
				'quantity'   => 1,
		];

		array_push($items, $shippingCost);

		Stripe::setApiKey($stripeSK);

		$session = Session::create([
				                           'line_items'  => [
						                           $items,
				                           ],
				                           'mode'        => 'payment',
				                           'success_url' => $this->generateUrl('success_url', ['orderNumber' => $orderNumber], UrlGeneratorInterface::ABSOLUTE_URL),
				                           'cancel_url'  => $this->generateUrl('cancel_url', ['orderNumber' => $orderNumber], UrlGeneratorInterface::ABSOLUTE_URL),
		                           ]);

		return $this->redirect($session->url, 303);
	}

	#[Route('/panier/stripe/success-{orderNumber}/', name: 'success_url')]
	public function success($orderNumber, MailJetService $mailJetService): Response {

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber]);

		$order->setStatus('Enregistrée - Paiement acceptée');
		$order->setSend('Commande enregistrée');

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($order);
		$entityManager->flush();


		/* ---------- PRODUCTS ---------- */

		$array_products = $order->getProductArray();
		$json_cart = implode(",", $array_products);
		$saved_products = json_decode($json_cart);

		$items = [];

		foreach ($saved_products as $product) {

			if ($product->discount == null) {
				$discount = 0;
			}
			else {
				$discount = $product->discount;
			}

			$unitPrice = ($product->price - ($product->price * (int)$discount / 100));

			$productLine = 'Nom du produit :' . $product->title . ' , Quantité : ' . $product->quantity . ' Prix :' . $unitPrice;

			array_push($items, $productLine);
		}


		/* -------- MAILJET -------- */

		$mailTo = $order->getCustomerEmail();
		$subject = "Confirmation de votre commande sur le site connectinha.fr";
		$templateId = 3465486;
		$firstName = $order->getCustomerFirstname() . ' ' . $order->getCustomerName();
		$name = $order->getCustomerName();
		$invoicingName = $order->getInvoicingName();
		$invoicingFirstname = $order->getInvoicingFirstname();

		$user_firstName = $order->getCustomerFirstname();
		$sendBy = 'contact@connectinha.fr';
		$phone = $order->getDeliveryPhoneNumber();
		$invoicingPhone = $order->getInvoicingPhoneNumber();
		$order_shippingCost = $order->getShippingCost();
		$order_totalPrice = $order->getPrice();
		$deliveryAdress = $order->getDeliveryAdress();
		$deliveryCity = $order->getDeliveryCity();
		$deliveryZipcode = $order->getZipcode();
		$deliveryCountry = $order->getCountry();

		$invoicingAdress = $order->getInvoicingAdress();
		$invoicingCity = $order->getInvoicingCity();
		$invoicingZipcode = $order->getInvoicingZipcode();
		$invoicingCountry = $order->getInvoicingCountry();

		$variables = [
				'name'               => $name,
				'user_firstName'     => $user_firstName,
				'invoicingName'      => $invoicingName,
				'invoicingFirstname' => $invoicingFirstname,
				'sendBy'             => $sendBy,
				'phone'              => $phone,
				'invoicingPhone'     => $invoicingPhone,
				'order_shippingCost' => $order_shippingCost,
				'order_totalPrice'   => $order_totalPrice,
				'orderNumber'        => $orderNumber,
				'deliveryAdress'     => $deliveryAdress,
				'deliveryCity'       => $deliveryCity,
				'deliveryZipcode'    => $deliveryZipcode,
				'deliveryCountry'    => $deliveryCountry,
				'invoicingAdress'    => $invoicingAdress,
				'invoicingCity'      => $invoicingCity,
				'invoicingZipcode'   => $invoicingZipcode,
				'invoicingCountry'   => $invoicingCountry,
				'products'           => $items,
		];

		$mailJetService->send($mailTo, $firstName, $subject, $templateId, $variables);

		return $this->render('payment/success.html.twig', [

		]);
	}

	#[Route('/panier/stripe/cancel-{orderNumber}/', name: 'cancel_url')]
	public function cancel($orderNumber): Response {

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber]);

		$order->setStatus('Enregistrée - Problème durant le paiement');

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($order);
		$entityManager->flush();

		return $this->render('payment/cancel.html.twig', [

		]);
	}


}
