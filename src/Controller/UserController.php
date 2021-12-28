<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Customer;
use App\Entity\Orders;
use App\Entity\Product;
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

class UserController extends AbstractController {

	#[Route('/votre-espace-client/', name: 'profile')]
	public function index(): Response {

		$user = $this->getUser();
		$customer = $user->getCustomer();

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['user' => $customer], ['id' => 'DESC']);
		$array_cart = $order->getProductArray();
		$json_cart = implode(",", $array_cart);

		$saved_products = json_decode($json_cart);

		$arrayProducts = [];

		// WIP Mantra
		$mantraSelected = null;

		foreach ($saved_products as $cartProduct) {

			$productId = $cartProduct->id;
			$quantity = $cartProduct->quantity;
			$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

			array_push($arrayProducts, $product);

		}

		dump($saved_products);

		return $this->render('user/index.html.twig', [
				'user'          => $user,
				'order'         => $order,
				'arrayProducts' => $arrayProducts,
				'savedProducts' => $saved_products,
		]);
	}

	#[Route('/votre-espace-client/votre-panier-sauvegarde/', name: 'profile_cart_saved')]
	public function cartSaved(): Response {

		$user = $this->getUser();
		$cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user' => $user], ['id' => 'DESC']);

		$array_cart = $cart->getProductArray();
		$json_cart = implode(",", $array_cart);

		$saved_products = json_decode($json_cart);

		$arrayProducts = [];

		foreach ($saved_products as $cartProduct) {

			$productId = $cartProduct->id;
			$quantity = $cartProduct->quantity;
			$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

			array_push($arrayProducts, $product);

		}

		dump($arrayProducts);

		return $this->render('user/cart.html.twig', [
				'user'          => $user,
				'cart'          => $cart,
				'arrayProducts' => $arrayProducts,
				'quantity'      => $quantity,
				'savedProducts' => $saved_products,
		]);
	}

	#[Route('/votre-espace-client/modifier-vos-informations/', name: 'profile_modify')]
	public function modifyProfile(Request $request): Response {

		$user = $this->getUser();
		$customerId = $user->getCustomer()->getId();

		dump($user);
		// AJOUTER EMAIL DANS CUSTOMER POUR NE PAS PERDRE LA CONNEXION A LA MODIFICATION

		$customer = $this->getDoctrine()->getRepository(Customer::class)->find($customerId);

		$form = $this->createFormBuilder()
				->add('name', TextType::class, [
						'label' => 'Votre nom *',
						'attr' => [
								'placeholder' => 'Nom',
								'value' => $user->getName()
						]
				])
				->add('firstname', TextType::class, [
						'label' => 'Votre prénom *',
						'attr' => [
								'placeholder' => 'Prénom',
								'value' => $user->getFirstName()
						]
				])
				->add('email', EmailType::class, [
						'label' => 'Votre email *',
						'attr' => [
								'placeholder' => 'Email',
								'value' => $user->getEmail()
						]
				])
				->add('phone', TelType::class, [
						'label' => 'Numéro de téléphone *',
						'attr'  => [
								'placeholder' => 'Téléphone du destinataire',
								'value'       => $customer->getPhone(),
						],
				])
				->add('delivery_adress_nb', TextareaType::class, [
						'label' => 'N° de rue *',
						'attr'  => [
								'placeholder' => 'N° et nom de la rue du destinataire',
								'value'       => $customer->getStreetNb(),
						],
				])
				->add('delivery_adress_street_name', TextareaType::class, [
						'label' => 'Nom de la rue *',
						'attr'  => [
								'placeholder' => 'N° et nom de la rue du destinataire',
								'value'       => $customer->getStreetName()
						],
				])
				->add('delivery_adress_street_name_2', TextareaType::class, [
						'label' => 'Nom de la rue',
						'attr'  => [
								'placeholder' => 'N° et nom de la rue du destinataire',
								'value'       => $customer->getStreetName2(),
						],
						'required' => false
				])
				->add('delivery_building', TextType::class, [
						'label'    => 'Bâtiment de livraison',
						'attr'     =>
								[
										'placeholder' => 'Bâtiment',
										'value'       => $customer->getBuilding(),
								],
						'required' => false,
				])
				->add('delivery_apartment', TextType::class, [
						'label'    => "N° d'appartement de livraison",
						'attr'     =>
								[
										'placeholder' => "n° d'appartement",
										'value'       => $customer->getApartment(),
								],
						'required' => false,
				])
				->add('delivery_zipcode', TextType::class, [
						'label' => 'Code postal de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Code postal',
										'value'       => $customer->getZipcode(),
								],
				])
				->add('delivery_city', TextType::class, [
						'label' => 'Ville de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Ville',
										'value'       => $customer->getCity(),
								],
				])
				->add('delivery_country', CountryType::class, [
						'label' => 'Pays de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Pays',
										'value'       => $customer->getCountry(),
								],
				])
				->add('submit', SubmitType::class, [
						'label' => 'Modifier'
				])

				->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$user->setName($form->get('name')->getData());
			$user->setFirstName($form->get('firstname')->getData());
			$user->setEmail($form->get('email')->getData());

			$customer->setPhone($form->get('phone')->getData());
			$customer->setStreetNb($form->get('delivery_adress_nb')->getData());
			$customer->setStreetName($form->get('delivery_adress_street_name')->getData());
			$customer->setStreetName2($form->get('delivery_adress_street_name_2')->getData());
			$customer->setBuilding($form->get('delivery_building')->getData());
			$customer->setApartment($form->get('delivery_apartment')->getData());
			$customer->setZipcode($form->get('delivery_zipcode')->getData());
			$customer->setCity($form->get('delivery_city')->getData());
			$customer->setCountry($form->get('delivery_country')->getData());


			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->persist($customer);
			$entityManager->flush();
		}

		return $this->render('user/modify.html.twig', [
				'form' => $form->createView(),
				'user' => $user
		]);
	}

}
