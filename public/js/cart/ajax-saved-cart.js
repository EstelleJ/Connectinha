import {ajax} from '../tools/functions.js';
import CartProduct from '../Classes/CartProduct.js';

// ============================================================================
// Variables
// ============================================================================
const cartRows = document.getElementsByTagName("cart-row");
const saveButton = document.getElementById("save-btn");


// ============================================================================
// Functions
// ============================================================================
async function getCart(e) {
	// e.preventDefault();
	let arrayProducts = [];
	let totalPrice = 0;
	let cartPrice = 0;

	for(let product of cartRows){

		let dataset = JSON.parse(product.dataset.product);

		let productId = dataset.id;
		let title     = dataset.title;
		let slug      = dataset.slug;
		let discount  = dataset.discount;
		let mantraSelected = dataset.mantra;
		let price     = dataset.price;
		let weight    = dataset.weight;

		let quantitySelected = product.querySelector('.item-quantity');
		arrayProducts.push(new CartProduct(productId, title, slug, discount, mantraSelected, parseInt(quantitySelected.value), price, weight));

		let priceQuantity = dataset.price * dataset.quantity;

		totalPrice += priceQuantity;

		cartPrice = totalPrice.toFixed(2);
	}

	console.log(arrayProducts);
	console.log(cartPrice);

	const element = this;

	let formData = new FormData();
	formData.append('ajax-array-products', JSON.stringify(arrayProducts));
	formData.append('ajax-cart-price', cartPrice);

	const response = await ajax('POST', '/ajax/save-cart/', formData);
	if (response === 'ok') {
		alert('panier sauvegardé');
	}

}


// ============================================================================
// Event listeners
// ============================================================================
saveButton.addEventListener('click', getCart);
