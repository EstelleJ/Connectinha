<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Customer;
use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController {

	#[Route('/votre-espace-client/', name: 'profile')]
	public function index(): Response {

		$user = $this->getUser();
		$customer = $user->getCustomer();

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['user' => $customer], ['id' => 'DESC']);

		$arrayProducts = [];
		$saved_products = '';

		if ($order !== null) {
			$array_cart = $order->getProductArray();
			$json_cart = implode(",", $array_cart);

			$saved_products = json_decode($json_cart);

			foreach ($saved_products as $cartProduct) {

				$productId = $cartProduct->id;
				$quantity = $cartProduct->quantity;
				$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

				array_push($arrayProducts, $product);

			}

			dump($saved_products);
		}


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
		$arrayProducts = [];
		$quantity = 0;
		$saved_products = '';

		if($cart !== null){
			$array_cart = $cart->getProductArray();
			$json_cart = implode(",", $array_cart);

			$saved_products = json_decode($json_cart);


			foreach ($saved_products as $cartProduct) {

				$productId = $cartProduct->id;
				$quantity = $cartProduct->quantity;
				$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

				array_push($arrayProducts, $product);

			}
		}


		return $this->render('user/cart.html.twig', [
				'user'          => $user,
				'cart'          => $cart,
				'arrayProducts' => $arrayProducts,
				'quantity'      => $quantity,
				'savedProducts' => $saved_products,
		]);
	}

	#[Route('/votre-espace-client/modifier-vos-informations/', name: 'profile_modify')]
	public function modifyProfile(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response {

		$user = $this->getUser();

		$customerId = $user->getCustomer()->getId();
		$customer = $this->getDoctrine()->getRepository(Customer::class)->find($customerId);

		dump($customer->getStreetNb());
		$form = $this->createFormBuilder()
				->add('password', PasswordType::class, [
						'label'    => 'Mot de passe',
						'required' => false,
				])
				->add('name', TextType::class, [
						'label' => 'Votre nom *',
						'attr'  => [
								'placeholder' => 'Nom',
								'value'       => $user->getName(),
						],
				])
				->add('firstname', TextType::class, [
						'label' => 'Votre prénom *',
						'attr'  => [
								'placeholder' => 'Prénom',
								'value'       => $user->getFirstName(),
						],
				])
				->add('email', EmailType::class, [
						'label' => 'Votre email de contact, ce mail vous permettra de recevoir les mails*',
						'attr'  => [
								'placeholder' => 'Email',
								'value'       => $user->getEmail(),
						],
				])
				->add('phone', TelType::class, [
						'label' => 'Numéro de téléphone *',
						'attr'  => [
								'placeholder' => 'Téléphone du destinataire',
								'value'       => $customer->getPhone(),
						],
				])
				->add('delivery_adress_nb', TextType::class, [
						'label' => 'N° de rue *',
						'attr'  => [
								'placeholder' => 'N° et nom de la rue du destinataire',
								'value'       => $customer->getStreetNb(),
						],
				])
				->add('delivery_adress_street_name', TextType::class, [
						'label'    => 'Nom de la rue *',
						'attr'     => [
								'placeholder' => $customer->getStreetName(),
								'value'       => $customer->getStreetName(),
						],
						'required' => false,
				])
				->add('delivery_adress_street_name_2', TextType::class, [
						'label'    => 'Nom de la rue',
						'attr'     => [
								'placeholder' => $customer->getStreetName2(),
								'value'       => $customer->getStreetName2(),
						],
						'required' => false,
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
						'label'             => 'Pays de livraison *',
						'attr'              =>
								[
										'placeholder' => 'Pays',
										'value'       => $customer->getCountry(),
								],
						'preferred_choices' => [$customer->getCountry()],
				])
				->add('submit', SubmitType::class, [
						'label' => 'Modifier',
				])
				->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			if ($form->get('password')->getData() !== null) {
				$user->setPassword(
						$passwordEncoder->encodePassword(
								$user,
								$form->get('password')->getData()
						)
				);
			}

			$user->setName($form->get('name')->getData());
			$user->setFirstName($form->get('firstname')->getData());

			$customer->setEmail($form->get('email')->getData());
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
				'user' => $user,
		]);
	}

	#[Route('/votre-espace-client/vos-commande/', name: 'profile_orders')]
	public function userOrders(): Response {

		$user = $this->getUser();
		$customer = $user->getCustomer();

		$orders = $this->getDoctrine()->getRepository(Orders::class)->findBy(['user' => $customer], ['id' => 'DESC']);

		return $this->render('user/orders.html.twig', [
				'user'   => $user,
				'orders' => $orders,
		]);
	}

	#[Route('/votre-espace-client/vos-commande-{id}/', name: 'profile_order_details')]
	public function orderDetails($id): Response {

		$user = $this->getUser();
		$customer = $user->getCustomer();

		$order = $this->getDoctrine()->getRepository(Orders::class)->find($id);

		$arrayProducts = [];
		$saved_products = '';

		if ($order !== null) {
			$array_cart = $order->getProductArray();
			$json_cart = implode(",", $array_cart);

			$saved_products = json_decode($json_cart);

			foreach ($saved_products as $cartProduct) {

				$productId = $cartProduct->id;
				$quantity = $cartProduct->quantity;
				$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

				array_push($arrayProducts, $product);

			}

			dump($saved_products);
		}

		return $this->render('user/order_detail.html.twig', [
				'user'   => $user,
				'order' => $order,
				'arrayProducts' => $arrayProducts,
				'savedProducts' => $saved_products,
		]);
	}

	#[Route('/votre-espace-client/vos-rendez-vous/', name: 'profile_rdv')]
	public function userRendezvous(): Response {

		$user = $this->getUser();

		return $this->render('user/rdvs.html.twig', [
				'user'   => $user,
		]);
	}


}
