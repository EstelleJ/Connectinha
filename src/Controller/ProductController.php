<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductSubcategory;
use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {

	#[Route('/nos-produits-{page}/', name: 'products')]
	public function index($page, PaginationService $paginationService): Response {

		$nbElements = 12;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Product::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$products = $this->getDoctrine()->getRepository(Product::class)->findBy(['active' => 1], ['id' => 'DESC'], $nbElements, $offset);

		$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy([], ['name' => 'ASC']);
		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy([], ['name' => 'ASC']);

		$link = 'products';
		$urlParameter = '';

		return $this->render('produit/index.html.twig', [
				'products'        => $products,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
				'categories'      => $categories,
				'subcategories'   => $subcategories,
				'link' => $link,
				'urlParameter' => $urlParameter
		]);
	}

	#[Route('/nos-produits-{page}/categorie-{categorySlug}-{categoryId}/', name: 'products_by_category')]
	public function productsByCategory($page, PaginationService $paginationService, $categoryId, $categorySlug): Response {

		$nbElements = 12;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Product::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([
																																														'active' => 1,
																																														'productCategory' => $categoryId
		                                                                                      ], ['id' => 'DESC'], $nbElements, $offset);

		$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy(['active' => 1], ['name' => 'ASC']);
		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy(['active' => 1], ['name' => 'ASC']);

		$link = 'products_by_category';

		return $this->render('produit/index.html.twig', [
				'products'        => $products,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
				'categories'      => $categories,
				'subcategories'   => $subcategories,
				'link' => $link,
				'categoryId' => $categoryId,
				'categorySlug' => $categorySlug
		]);
	}

	#[Route('/nos-produits-{page}/sous-categorie-{subcategorySlug}-{subcategoryId}/', name: 'products_by_subcategory')]
	public function productsBySubcategory($page, PaginationService $paginationService, $subcategoryId, $subcategorySlug): Response {

		$nbElements = 12;

		if ($page == '1') {
			$offset = 0;
		}
		else {
			$offset = (($page - 1) * $nbElements);
		}

		$elements = $this->getDoctrine()->getRepository(Product::class)->findAll();

		$arrayPagination = $paginationService->pagination($elements, $nbElements);

		$products = $this->getDoctrine()->getRepository(Product::class)->findBySubcategory($subcategoryId, $nbElements, $offset);

		$categories = $this->getDoctrine()->getRepository(ProductCategory::class)->findBy(['active' => 1], ['name' => 'ASC']);
		$subcategories = $this->getDoctrine()->getRepository(ProductSubcategory::class)->findBy(['active' => 1], ['name' => 'ASC']);

		$link = 'products_by_subcategory';

		return $this->render('produit/index.html.twig', [
				'products'        => $products,
				'arrayPagination' => $arrayPagination,
				'currentPage'     => $page,
				'elements'        => $elements,
				'categories'      => $categories,
				'subcategories'   => $subcategories,
				'link' => $link,
				'subcategoryId' => $subcategoryId,
				'subcategorySlug' => $subcategorySlug
		]);
	}

	#[Route('/nos-produits/details-{slug}-{id}/', name: 'product_details', requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
	public function details($id): Response {

		$product = $this->getDoctrine()->getRepository(Product::class)->findOneBy([
				                                                                          'active' => 1,
				                                                                          'id'     => $id], []);

		return $this->render('produit/details.html.twig', [
				'product' => $product,
		]);
	}
}
