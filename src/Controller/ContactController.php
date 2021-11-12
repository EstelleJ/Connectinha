<?php

namespace App\Controller;

use App\Service\MailJetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {

	#[Route('/contact/', name: 'contact')]
	public function index(Request $request, MailJetService $mailJetService): Response {

		$form = $this->createFormBuilder()
				->add('name', TextType::class, [
						'label' => 'Votre nom *'
				])
				->add('firstname', TextType::class, [
						'label' => 'Votre prénom *'
				])
				->add('email', EmailType::class, [
						'label' => 'Votre email *'
				])
				->add('phone', TelType::class, [
						'label' => 'Votre numéro de téléphone',
						'required' => false
				])
				->add('subject', TextType::class, [
						'label' => 'Le sujet de votre message *',
						'required' => false
				])
				->add('text', TextareaType::class, [
						'label' => 'Votre message *'
				])
				->getForm();

		$form->handleRequest($request);

		$error = '';

		if ($form->isSubmitted() && $form->isValid()) {
			// Envoi d'un mail d'inscription via MailJet
			$mailTo = 'contact@mindcursus.fr';
			$subject = "Vous avez reçu un message";
			$templateId = 3312132;
			$firstName = "Formulaire de contact Mindcursus";
			$name = $form->get('name')->getData();
			$user_firstName = $form->get('firstname')->getData();
			$sendBy = $form->get('email')->getData();
			$phone = $form->get('phone')->getData();
			$messageSubject = $form->get('subject')->getData();
			$message = $form->get('text')->getData();

			$variables = [
					'name'           => $name,
					'user_firstName' => $user_firstName,
					'sendBy'         => $sendBy,
					'phone'          => $phone,
					'messageSubject' => $messageSubject,
					'message'        => $message,
			];

			if(!empty($request->request->get('recaptcha-response'))){
				$response = $mailJetService->send($mailTo, $firstName, $subject, $templateId, $variables);

				if($response->getStatus() == 200){
					return $this->redirectToRoute('contact_confirm');
				}
				elseif($response->getStatus() == 400) {
					$error = "Une erreur 400 s'est produite. Nous sommes désolés pour la gêne occasionnée.";
				}
				elseif($response->getStatus() == 403) {
					$error = "Une erreur 403 s'est produite. Nous sommes désolés pour la gêne occasionnée.";
				}
				elseif($response->getStatus() == 500) {
					$error = "Une erreur 500 s'est produite. Nous sommes désolés pour la gêne occasionnée.";
				}
				else {
					$error = "Une erreur s'est produite. Nous sommes désolés pour la gêne occasionnée.";
				}
			}
			else {
				$error = "Veuillez effectuer la vérification ReCaptcha";
			}

		}




		return $this->render('contact/index.html.twig', [
				'form' => $form->createView(),
				'error' => $error
		]);
	}

	#[Route('/contact/confirmation/', name: 'contact_confirm')]
	public function confirmation(Request $request, MailJetService $mailJetService): Response {

		return $this->render('contact/confirmation.html.twig', [

		]);
	}

}
