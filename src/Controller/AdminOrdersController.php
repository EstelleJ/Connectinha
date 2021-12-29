<?php

namespace App\Controller;

use App\Entity\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrdersController extends AbstractController
{
    #[Route('/admin/commandes/commande-{id}/', name: 'admin_orders_modify')]
    public function index($id, Request $request): Response
    {
    	  $order = $this->getDoctrine()->getRepository(Orders::class)->find($id);

		    $array_products = $order->getProductArray();
		    $json_cart = implode(",", $array_products);
		    $saved_products = json_decode($json_cart);

		    $form = $this->createFormBuilder()
				    ->add('send', ChoiceType::class, [
						    'label' => "Statut d'envoi",
						    'choices' => [
						    		'Commande enregistrée' => 'Commande enregistrée',
							      'En cours de préparation' => 'En cours de préparation',
							      'Commande expédiée' => 'Commande expédiée'
						    ],
					      'preferred_choices' => [$order->getSend()],
				    ])
				    ->add('message', TextareaType::class, [
				    		'label' => 'Message pour le mail qui sera envoyé à la modification du statut',
					      'attr' => [
							      'placeholder' => 'Ce message peut être un message de remerciement personnalisé....',
					      ],
					      'required' => false
				    ])
				    ->add('delay', TextareaType::class, [
				    		'label' => 'Message concernant le délais de livraison',
					      'required' => false,
		            'attr' => [
				            'placeholder' => 'Ce message vous permet de dire à votre client, une fourchette dans laquelle il recevera son colis'
		            ],

				    ])
				    ->add('submit', SubmitType::class, [
				    		'label' => 'Sauvegarder'
				    ])
				    ->getForm();

		    $form->handleRequest($request);

	      if ($form->isSubmitted() && $form->isValid()) {
		      $order->setSend($form->get('send')->getData());

		      $entityManager = $this->getDoctrine()->getManager();
		      $entityManager->persist($order);
		      $entityManager->flush();
	      }

        return $this->render('admin/orders_modify.html.twig', [
            'order' => $order,
	          'saved_products' => $saved_products,
            'form' => $form->createView(),
        ]);
    }
}
