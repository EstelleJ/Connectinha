<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription/', name: 'app_register')]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, AdminService $adminService): Response
    {
        $user = new User();
        $client = new Customer();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

		        $user = $form->getData();

		        $name = $user->getName() .'-'. $user->getFirstName();

		        // Appel de la fonction slug définie dans le service AdminService //
		        $slug = $adminService->slugify($name);

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            $user->setActive(1);
            $user->setClient($client);

            $client->setSlug($slug);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
	          $entityManager->persist($client);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
