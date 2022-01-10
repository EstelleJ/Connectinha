<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Customer;
use App\Entity\DiscountTicket;
use App\Entity\FreeShipping;
use App\Entity\MantraProducts;
use App\Entity\Orders;
use App\Entity\PaymentMethod;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductImage;
use App\Entity\ProductSubcategory;
use App\Entity\Services;
use App\Entity\ServicesContent;
use App\Entity\ShippingCost;
use App\Entity\SpecialOffer;
use App\Entity\Tva;
use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController {


	// ------------------- DELETES --------------------- //
	// ------------------------------------------------- //

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

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/shipping', name: 'ajax_delete_shipping')]
	public function deleteShipping(Request $request): Response {

		$content_id = $request->request->get('ajax-shipping-id');
		$entityManager = $this->getDoctrine()->getManager();

		$content = $this->getDoctrine()->getRepository(ShippingCost::class)->find($content_id);

		$entityManager->remove($content);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/discount', name: 'ajax_delete_discount')]
	public function deleteDiscountTicket(Request $request): Response {

		$discount_id = $request->request->get('ajax-discount-id');
		$entityManager = $this->getDoctrine()->getManager();

		$content = $this->getDoctrine()->getRepository(DiscountTicket::class)->find($discount_id);

		$entityManager->remove($content);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete/special-offers', name: 'ajax_delete_offer')]
	public function deleteOffer(Request $request): Response {

		$offer_id = $request->request->get('ajax-offer-id');
		$entityManager = $this->getDoctrine()->getManager();

		$content = $this->getDoctrine()->getRepository(SpecialOffer::class)->find($offer_id);

		$entityManager->remove($content);
		$entityManager->flush();

		return new JsonResponse('ok');

	}

	// ------------------- GET CART --------------------- //
	// -------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/get-product/', name: 'ajax_get_product')]
	public function getProduct(Request $request): Response {

		$productId = $request->request->get('id');
		$mantraCart = $request->request->get('mantra');

		$product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

		$discount = 'null';
		$mantraSelected = null;

		if ($product->getSpecialOffer() !== null) {
			$discount = $product->getSpecialOffer()->getOffer();
		}

		if ($product->getMantraProducts() !== null) {
			foreach ($product->getMantraProducts() as $mantra) {
				if ($mantraCart === $mantra->getMantra()) {
					$mantraSelected = $mantra->getMantra();
				}
			}
		}

		$responseProduct = [
				'name'     => $product->getName(),
				'price'    => $product->getPrice(),
				'discount' => $discount,
				'mantra'   => $mantraSelected,
		];
		return new JsonResponse($responseProduct);
	}


	// ------------------- SAVE CART --------------------- //
	// --------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/save-cart/', name: 'ajax_save_cart')]
	public function saveCart(Request $request): Response {

		$arrayProducts = $request->request->get('ajax-array-products');
		$totalPrice = $request->request->get('ajax-cart-price');

		$user = $this->getUser();

		// dump($arrayProducts);

		$cart = new Cart();

		$cart->setDate(new DateTime('now'));
		$cart->setProductArray([$arrayProducts]);
		$cart->setUser($user);
		$cart->setPrice($totalPrice);

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($cart);
		$entityManager->flush();

		return new JsonResponse('ok');
	}

	// ------------------- GET SHIPPING COST --------------------- //
	// ----------------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/get-shipping-cost/', name: 'ajax_get_shipping_cost')]
	public function getShippingCost(Request $request): Response {

		$totalWeight = $request->request->get('ajax-total-weight');
		$totalPrice = $request->request->get('ajax-total-price');

		$shippingCosts = $this->getDoctrine()->getRepository(ShippingCost::class)->findAll();

		$shippingPrice = 0;

		$freeShipping = $this->getDoctrine()->getRepository(FreeShipping::class)->find(1);
		$freeShippingPrice = $freeShipping->getPrice();

		foreach ($shippingCosts as $cost) {
			if ($totalWeight > $cost->getMin() && $totalWeight < $cost->getMax()) {
				$shippingPrice = $cost->getPrice();
			}
		}

		if($totalPrice > $freeShippingPrice) {
			$shippingPrice = 0;
		}

		return new JsonResponse($shippingPrice);
	}

	// ------------------- GET DISCOUNT TICKET --------------------- //
	// ----------------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/get-discount-ticket/', name: 'ajax_get_discount')]
	public function getDiscountTicket(Request $request): Response {

		$discountTicket = $request->request->get('ajax-discount-ticket');
		$arrayProducts = $request->request->get('ajax-array-products');

		$totalWeight = 0;
		$totalPrice = 0;

		foreach (json_decode($arrayProducts) as $product) {

			$productId = $product->id;

			$productDB = $this->getDoctrine()->getRepository(Product::class)->find($productId);

			$promo = 0;
			if ($productDB->getSpecialOffer()) {
				$promo = $productDB->getSpecialOffer()->getOffer();
			}

			$priceUnit = $product->price - ($product->price * $promo / 100);
			$quantity = $product->quantity;
			$weight = $productDB->getWeight();

			$totalWeight += $weight * $quantity;

			$totalPrice += $priceUnit * $quantity;
		}

		$shippingCosts = $this->getDoctrine()->getRepository(ShippingCost::class)->findAll();

		$shippingPrice = 0;

		foreach ($shippingCosts as $cost) {
			if ($totalWeight > $cost->getMin() && $totalWeight < $cost->getMax()) {
				$shippingPrice = $cost->getPrice();
			}
		}

		$ticket = $this->getDoctrine()->getRepository(DiscountTicket::class)->findOneBy(['code' => $discountTicket]);

		$price = $totalPrice;
		$discount = 0;

		if ($ticket == null) {
			$discount = 'invalid';
		}
		else {

			if ($ticket->getCode() === $discountTicket) {
				if ($ticket->getAmount() !== null && $ticket->getPercent() === null) {
					$price = (float)$totalPrice - (float)$ticket->getAmount();
					$discount = $ticket->getAmount() . '€';
				}
				elseif ($ticket->getPercent() !== null && $ticket->getAmount() === null) {
					$price = (float)$totalPrice - ((float)$totalPrice * ((float)$ticket->getPercent() / 100));
					$discount = $ticket->getPercent() . '%';
				}
				elseif ($ticket->getAmount() !== null && $ticket->getPercent() !== null) {
					$discountPercent = (float)$totalPrice - ((float)$totalPrice * ((float)$ticket->getPercent() / 100));
					$price = $discountPercent - (float)$ticket->getAmount();
					$discount = $ticket->getPercent() . '%, plus ' . $ticket->getAmount() . '€ supplémentaires';
				}
			}
			else {
				$discount = 'invalid';
			}

		}

		$price = $price + $shippingPrice;

		return new JsonResponse([
				                        'price'    => $price,
				                        'discount' => $discount,
		                        ]);
	}

	// ------------------- NEW ORDER --------------------- //
	// --------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/new-order/', name: 'ajax_new_order')]
	public function newOrder(Request $request): Response {

		$arrayProducts = $request->request->get('ajax-array-products');
		$totalPrice = 0;
		$discountTicket = $request->request->get('ajax-discount-ticket');

		$freeShipping = $this->getDoctrine()->getRepository(FreeShipping::class)->find(1);
		$freeShippingPrice = $freeShipping->getPrice();

		$user = $this->getUser();

		$customer = null;
		if ($user) {
			$customer = $user->getCustomer();
		}

		$totalWeight = 0;

		foreach (json_decode($arrayProducts) as $product) {

			$productId = $product->id;

			$productDB = $this->getDoctrine()->getRepository(Product::class)->find($productId);

			$promo = 0;
			if ($productDB->getSpecialOffer()) {
				$promo = $productDB->getSpecialOffer()->getOffer();
			}

			$priceUnit = $product->price - ($product->price * $promo / 100);
			$quantity = $product->quantity;
			$weight = $productDB->getWeight();

			$totalWeight += $weight * $quantity;

			$totalPrice += $priceUnit * $quantity;
		}

		$shippingCosts = $this->getDoctrine()->getRepository(ShippingCost::class)->findAll();

		$shippingPrice = 0;

		foreach ($shippingCosts as $cost) {
			if ($totalWeight > $cost->getMin() && $totalWeight < $cost->getMax()) {
				$shippingPrice = $cost->getPrice();
			}
		}

		$ticket = $this->getDoctrine()->getRepository(DiscountTicket::class)->findOneBy(['code' => $discountTicket]);

		$price = $totalPrice;
		$bug = 0;

		if ($ticket !== null) {

			if ($ticket->getCode() === $discountTicket) {
				if ($ticket->getAmount() !== null && $ticket->getPercent() === null) {
					$price = (float)$totalPrice - (float)$ticket->getAmount();
				}
				elseif ($ticket->getPercent() !== null && $ticket->getAmount() === null) {
					$price = (float)$totalPrice - ((float)$totalPrice * ((float)$ticket->getPercent() / 100));
				}
				elseif ($ticket->getAmount() !== null && $ticket->getPercent() !== null) {
					$discountPercent = (float)$totalPrice - ((float)$totalPrice * ((float)$ticket->getPercent() / 100));
					$price = $discountPercent - (float)$ticket->getAmount();
				}
			}
		}

		if($price > $freeShippingPrice) {
			$shippingPrice = 0;
		}

		$price = $price + $shippingPrice;

		$order = new Orders();

		$number = uniqid('C-');

		$order->setOrderNumber($number);
		$order->setDate(new DateTime('now'));
		$order->setStatus('Non finalisée');
		$order->setSend('Non enregistrée');
		$order->setProductArray([$arrayProducts]);
		$order->setPrice($price);
		$order->setDiscountTicket($discountTicket);
		$order->setUser($customer);
		$order->setShippingCost($shippingPrice);

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($order);
		$entityManager->flush();

		return new JsonResponse([
				                        'orderNumber' => $number,
				                        'customer'    => $customer,
		                        ]);
	}


	// ------------------- NEW ORDER --------------------- //
	// --------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/get-order/', name: 'ajax_get_order')]
	public function getOrder(Request $request): Response {

		$orderNumber = $request->request->get('ajax-order-number');

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber], ['id' => 'DESC']);

		$discount = 0;

		if ($order->getDiscountTicket()) {
			$discountTicket = $this->getDoctrine()->getRepository(DiscountTicket::class)->findOneBy(['code' => $order->getDiscountTicket()]);
			if ($discountTicket->getCode()) {
				if ($discountTicket->getAmount() !== null && $discountTicket->getPercent() === null) {
					$discount = $discountTicket->getAmount() . '€';
				}
				elseif ($discountTicket->getPercent() !== null && $discountTicket->getAmount() === null) {
					$discount = $discountTicket->getPercent() / 100 . '%';
				}
				elseif ($discountTicket->getAmount() !== null && $discountTicket->getPercent() !== null) {
					$discount = $discountTicket->getPercent() . '%, plus ' . $discountTicket->getAmount() . '€ supplémentaires';
				}
			}
			else {
				$discount = 0;
			}
		}

		return new JsonResponse([
				                        'products'     => $order->getProductArray(),
				                        'ticket'       => $order->getDiscountTicket(),
				                        'discount'     => $discount,
				                        'price'        => $order->getPrice(),
				                        'shippingCost' => $order->getShippingCost(),
		                        ]);
	}

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/update-order/', name: 'ajax_update_order')]
	public function updateOrder(Request $request): Response {

		$orderNumber = $request->request->get('ajax-order-number');

		$deliveryName = $request->request->get('ajax-delivery-name');
		$deliveryFirstname = $request->request->get('ajax-delivery-firstname');
		$deliveryEmail = $request->request->get('ajax-delivery-email');
		$deliveryPhone = $request->request->get('ajax-delivery-phone');
		$deliveryAdress = $request->request->get('ajax-delivery-adress');
		$deliveryBuilding = $request->request->get('ajax-delivery-building');
		$deliveryApartment = $request->request->get('ajax-delivery-apartment');
		$deliveryCity = $request->request->get('ajax-delivery-city');
		$deliveryZipcode = $request->request->get('ajax-delivery-zipcode');
		$deliveryCountry = $request->request->get('ajax-delivery-country');

		$invoicingName = $request->request->get('ajax-invoicing-name');
		$invoicingFirstname = $request->request->get('ajax-invoicing-firstname');
		$invoicingEmail = $request->request->get('ajax-invoicing-email');
		$invoicingPhone = $request->request->get('ajax-invoicing-phone');
		$invoicingAdress = $request->request->get('ajax-invoicing-adress');
		$invoicingBuilding = $request->request->get('ajax-invoicing-building');
		$invoicingApartment = $request->request->get('ajax-invoicing-apartment');
		$invoicingCity = $request->request->get('ajax-invoicing-city');
		$invoicingZipcode = $request->request->get('ajax-invoicing-zipcode');
		$invoicingCountry = $request->request->get('ajax-invoicing-country');

		$order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(['orderNumber' => $orderNumber]);

		$order->setDeliveryAdress($deliveryAdress);
		$order->setZipcode($deliveryZipcode);
		$order->setDeliveryCity($deliveryCity);
		$order->setCountry($deliveryCountry);
		$order->setDeliveryPhoneNumber($deliveryPhone);
		$order->setDeliveryBuilding($deliveryBuilding);
		$order->setDeliveryApartment($deliveryApartment);
		$order->setCustomerName($deliveryName);
		$order->setCustomerFirstname($deliveryFirstname);
		$order->setCustomerEmail($deliveryEmail);

		$order->setInvoicingAdress($invoicingAdress);
		$order->setInvoicingZipcode($invoicingZipcode);
		$order->setInvoicingCity($invoicingCity);
		$order->setInvoicingCountry($invoicingCountry);
		$order->setInvoicingPhoneNumber($invoicingPhone);
		$order->setInvoicingBuilding($invoicingBuilding);
		$order->setInvoicingApartment($invoicingApartment);
		$order->setInvoicingName($invoicingName);
		$order->setInvoicingFirstname($invoicingFirstname);
		$order->setInvoicingEmail($invoicingEmail);

		$order->setStatus('Non finalisée - arrêt avant paiement');

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($order);
		$entityManager->flush();

		return new JsonResponse($orderNumber);

	}

	// --------------------- REDIRECT ORDER ---------------------- //
	// ----------------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/redirect-order/', name: 'ajax_redirect_order')]
	public function redirectOrder(Request $request): Response {

		$orderNumber = $request->request->get('ajax-order-number');
		$user = $this->getUser()->getId();

		return new JsonResponse($user);
	}

	// ----------------------- DELETE USER ----------------------- //
	// ----------------------------------------------------------- //

	/**
	 * @param Request $request
	 * @return Response
	 */
	#[Route('/ajax/delete-user/', name: 'ajax_delete_user')]
	public function deleteUser(Request $request): Response {

		$user = $this->getUser();
		$customer = $user->getCustomer();

		$user = $this->getDoctrine()->getRepository(User::class)->find($user);
		$customer = $this->getDoctrine()->getRepository(Customer::class)->find($customer);

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($customer);
		$entityManager->remove($user);
		$entityManager->flush();

		return new JsonResponse('ok');

	}


}
