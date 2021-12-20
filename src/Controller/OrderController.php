<?php

namespace App\Controller;

use App\Entity\Orders;
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

class OrderController extends AbstractController {

	#[Route('/panier/commande/', name: 'order')]
	public function index(): Response {

		return $this->render('order/index.html.twig', [

		]);
	}

	#[Route('/panier/commande/recapitulatif/', name: 'order_details')]
	public function details(Request $request): Response {

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => 'C33-177847']);

		$form = $this->createFormBuilder()
				->add('name', TextType::class, [
						'label' => 'Nom *',
						'attr'  => [
								'placeholder' => 'Nom du destinataire',
						],
				])
				->add('firstname', TextType::class, [
						'label' => 'Prénom *',
						'attr'  => [
								'placeholder' => 'Prénom du destinataire',
						],
				])
				->add('email', EmailType::class, [
						'label' => 'Email *',
						'attr'  => [
								'placeholder' => 'Email du destinataire',
						],
				])
				->add('phone', TelType::class, [
						'label' => 'Numéro de téléphone *',
						'attr'  => [
								'placeholder' => 'Téléphone du destinataire',
						],
				])
				->add('delivery_adress', TextareaType::class, [
						'label' => 'Adresse de livraison *',
						'attr' => [
								'placeholder' => 'N° et nom de la rue du destinataire'
						]
				])
				->add('delivery_building', TextType::class, [
						'label' => 'Bâtiment de livraison',
						'attr'  =>
								[
										'placeholder' => 'Bâtiment',
								],
						'required' => false
				])
				->add('delivery_apartment', TextType::class, [
				'label' => "N° d'appartement de livraison",
				'attr'  =>
						[
								'placeholder' => "n° d'appartement",
						],
						'required' => false
				])
				->add('delivery_zipcode', TextType::class, [
				'label' => 'Code postal de livraison *',
				'attr'  =>
						[
								'placeholder' => 'Code postal',
						],
		])
				->add('delivery_city', TextType::class, [
						'label' => 'Ville de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Ville',
								],
				])
				->add('delivery_country', CountryType::class, [
						'label' => 'Pays de livraison *',
						'attr'  =>
								[
										'placeholder' => 'Pays',
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
						'label'    => 'Numéro de téléphone *',
						'attr'     => [
								'placeholder' => 'Téléphone du destinataire',
						],

				])
				->add('invoicing_adress', TextareaType::class, [
						'label' => 'Adresse de facturation *',
						'attr' => [
								'placeholder' => 'N° et nom de la rue pour la facture'
						]
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
						'label' => "N° d'appartement de facturation",
						'attr'  =>
								[
										'placeholder' => "n° d'appartement",
								],
						'required' => false
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
}
