import {ajax} from '../tools/functions.js';
import CartProduct from '../Classes/CartProduct.js';

// ============================================================================
// Variables
// ============================================================================
const cartRows       = document.getElementsByTagName("cart-row");
const confirmButton  = document.getElementById("confirm-btn");
const discountTicket = document.getElementById('discountTicket').value;
const domTotalPrice  = document.getElementById('cart-total-price');

// ============================================================================
// Functions
// ============================================================================
async function getOrder(e) {
	e.preventDefault();
	let arrayProducts = [];
	let cartPrice     = 0;

	let totalPrice = domTotalPrice.innerHTML.split(' ')[0];

	const discountTicket = document.getElementById('discountTicket').value;

	console.log(discountTicket);
	console.log('totalPrice = ' + totalPrice);

	for (let product of cartRows) {

		let dataset = JSON.parse(product.dataset.product);

		let productId      = dataset.id;
		let title          = dataset.title;
		let slug           = dataset.slug;
		let discount       = dataset.discount;
		let mantraSelected = dataset.mantra;
		let price          = dataset.price;
		let weight         = dataset.weight;

		let quantitySelected = product.querySelector('.item-quantity');
		arrayProducts.push(new CartProduct(productId, title, slug, discount, mantraSelected, parseInt(quantitySelected.value), price, weight));

		cartPrice = totalPrice;
	}

	console.log(arrayProducts);
	console.log(cartPrice);

	const element = this;

	let formData = new FormData();
	formData.append('ajax-array-products', JSON.stringify(arrayProducts));
	formData.append('ajax-cart-price', cartPrice.toString());
	formData.append('ajax-discount-ticket', discountTicket);

	const response = await ajax('POST', '/ajax/new-order/', formData);

	localStorage.setItem('order', response.orderNumber);

	const customer = response.customer;

	console.log(response);

	// if (customer !== null) {
	// 	window.location.href = '/panier/commande/recapitulatif-' + response.orderNumber + '/';
	// }
	// else {
	// 	window.location.href = '/panier/commande/';
	// }
}


// ============================================================================
// Event listeners
// ============================================================================
confirmButton.addEventListener('click', getOrder);
