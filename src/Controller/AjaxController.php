<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\MantraProducts;
use App\Entity\PaymentMethod;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductImage;
use App\Entity\ProductSubcategory;
use App\Entity\Services;
use App\Entity\ServicesContent;
use App\Entity\Tva;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController {

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/category', name: 'ajax_delete_category')]
	public function deleteCategory(Request $request): Response {

		$category_id = $request->request->get('ajax-category-id');
		$entityManager = $this->getDoctrine()->getManager();

		$category = $this->getDoctrine()->getRepository(ProductCategory::class)->find($category_id);

		$entityManager->remove($category);
		$entityManager->flush();

		return new JsonResponse('ok');

	}


	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/subcategory', name: 'ajax_delete_subcategory')]
	public function deleteSubcategory(Request $request): Response {

		$subcategory_id = $request->request->get('ajax-subcategory-id');
		$entityManager = $this->getDoctrine()->getManager();

		$subcategory = $this->getDoctrine()->getRepository(ProductSubcategory::class)->find($subcategory_id);

		$entityManager->remove($subcategory);
		$entityManager->flush();

		return new JsonResponse('ok');

	}


	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/product', name: 'ajax_delete_product')]
	public function deleteProduct(Request $request): Response {

		$product_id = $request->request->get('ajax-product-id');
		$entityManager = $this->getDoctrine()->getManager();

		$product = $this->getDoctrine()->getRepository(Product::class)->find($product_id);

		$entityManager->remove($product);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/product/img/', name: 'ajax_delete_product_img')]
	public function deleteProductImg(Request $request): Response {

		$product_img_id = $request->request->get('ajax-product-img-id');
		$entityManager = $this->getDoctrine()->getManager();

		$productImg = $this->getDoctrine()->getRepository(ProductImage::class)->find($product_img_id);

		$entityManager->remove($productImg);
		$entityManager->flush();

		return new JsonResponse('ok');

	}


	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/tva', name: 'ajax_delete_tva')]
	public function deleteTva(Request $request): Response {

		$tva_id = $request->request->get('ajax-tva-id');
		$entityManager = $this->getDoctrine()->getManager();

		$tva = $this->getDoctrine()->getRepository(Tva::class)->find($tva_id);

		$entityManager->remove($tva);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/customer', name: 'ajax_delete_customer')]
	public function deleteCustomer(Request $request): Response {

		$customer_id = $request->request->get('ajax-customer-id');
		$entityManager = $this->getDoctrine()->getManager();

		$customer = $this->getDoctrine()->getRepository(Customer::class)->find($customer_id);

		$entityManager->remove($customer);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/method', name: 'ajax_delete_method')]
	public function deletePaymentMethods(Request $request): Response {

		$method_id = $request->request->get('ajax-method-id');
		$entityManager = $this->getDoctrine()->getManager();

		$method = $this->getDoctrine()->getRepository(PaymentMethod::class)->find($method_id);

		$entityManager->remove($method);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/service', name: 'ajax_delete_service')]
	public function deleteService(Request $request): Response {

		$service_id = $request->request->get('ajax-service-id');
		$entityManager = $this->getDoctrine()->getManager();

		$service = $this->getDoctrine()->getRepository(Services::class)->find($service_id);

		$entityManager->remove($service);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/mantra', name: 'ajax_delete_mantra')]
	public function deleteMantra(Request $request): Response {

		$mantra_id = $request->request->get('ajax-mantra-id');
		$entityManager = $this->getDoctrine()->getManager();

		$mantra = $this->getDoctrine()->getRepository(MantraProducts::class)->find($mantra_id);

		$entityManager->remove($mantra);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/content', name: 'ajax_delete_content')]
	public function deleteContent(Request $request): Response {

		$content_id = $request->request->get('ajax-content-id');
		$entityManager = $this->getDoctrine()->getManager();

		$content = $this->getDoctrine()->getRepository(ServicesContent::class)->find($content_id);

		$entityManager->remove($content);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

}
