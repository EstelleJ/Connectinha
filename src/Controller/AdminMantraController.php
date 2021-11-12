<?php

namespace App\Controller;

use App\Entity\MantraProducts;
use App\Form\MantraProductsType;
use App\Service\AdminService;
use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMantraController extends AbstractController
{
    #[Route('/admin/les-mantras-{page}/', name: 'admin_mantra')]
    public function index($page, PaginationService $paginationService): Response
    {
	    $nbElements = 7;

	    if ($page == '1') {
		    $offset = 0;
	    }
	    else {
		    $offset = (($page - 1) * $nbElements);
	    }

	    $elements = $this->getDoctrine()->getRepository(MantraProducts::class)->findAll();
	    $arrayPagination = $paginationService->pagination($elements, $nbElements);

	    $mantras = $this->getDoctrine()->getRepository(MantraProducts::class)->findBy([], ['id' => 'DESC'], $nbElements, $offset);

	    return $this->render('admin/products_mantra.html.twig', [
            'mantras' => $mantras,
            'arrayPagination' => $arrayPagination,
            'currentPage'     => $page,
            'elements'        => $elements,
        ]);
    }


	#[Route('/admin/les-mantras/ajouter/', name: 'admin_mantra_add')]
	public function add(Request $request, AdminService $adminService): Response {
		$mantras = $this->getDoctrine()->getRepository(MantraProducts::class)->findBy([], ['id' => 'DESC'], 3);

		$mantra = new MantraProducts();
		$error = '';

		$form = $this->createForm(MantraProductsType::class, $mantra);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($mantra);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$mantras = $this->getDoctrine()->getRepository(MantraProducts::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $mantra->getMantra() . '" a été ajouté avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/products_mantra_add.html.twig', [
				'form'     => $form->createView(),
				'mantras' => $mantras,
				'error'    => $error,
		]);
	}

	#[Route('/admin/les-mantras/modifier-{id}/', name: 'admin_mantra_modify')]
	public function modify(Request $request, AdminService $adminService, $id): Response {
		$mantra = $this->getDoctrine()->getRepository(MantraProducts::class)->find($id);
		$mantras = $this->getDoctrine()->getRepository(MantraProducts::class)->findBy([], ['id' => 'DESC'], 3);

		$error = '';

		$form = $this->createForm(MantraProductsType::class, $mantra);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($mantra);
			$entityManager->flush();

			// Mise à jour des produits après ajout //
			$mantras = $this->getDoctrine()->getRepository(MantraProducts::class)->findBy([], ['id' => 'DESC'], 3);

			$this->addFlash("success", '"' . $mantra->getMantra() . '" a été modifié avec succès');
			// return $this->redirectToRoute('task_success');
		}

		return $this->render('admin/products_mantra_add.html.twig', [
				'form'     => $form->createView(),
				'mantra' => $mantra,
				'mantras' => $mantras,
				'error'    => $error,
		]);
	}


}
