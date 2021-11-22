import {ajax} from './tools/functions.js';

// ============================================================================
// Class
// ============================================================================

class CartProduct {
	constructor(id, mantra, quantity, price, weight) {
		this.id     = id;
		this.mantra = mantra;
		this.quantity = quantity;
		this.price = price;
		this.weight = weight;
	}
}

// ============================================================================
// Variables
// ============================================================================
const addCartButton = document.getElementById("addCart");


// ============================================================================
// Functions
// ============================================================================
async function addCart() {

	const element = this;

	let productId = this.dataset.id;
	let mantra    = this.dataset.mantra;
	let quantity = this.dataset.quantity;
	let price = this.dataset.price;
	let weight = this.dataset.weight;

	let formData = new FormData();
	formData.append('ajax-product-id', productId);

	let arrayProducts = [];

	arrayProducts.push(new CartProduct(productId, mantra, quantity, price, weight));

	console.log(arrayProducts);

	let localStorageItems = localStorage.getItem('products');

	console.log('storage cart:');
	console.log(localStorageItems);
	console.log('===========================');
	if (!!localStorageItems) {
		let cart = JSON.parse(localStorageItems);
		cart.push(new CartProduct(productId, mantra, quantity, price, weight));
		localStorage.setItem('products', JSON.stringify(cart));
	}
	else {
		localStorage.setItem('products', JSON.stringify(arrayProducts));
	}

	console.log('new cart:');
	console.log(localStorage.getItem('products'));
	console.log('========================');


	// const response = await ajax('POST', '/ajax/add-cart/', formData);
	//if (response === 'ok') {
	// Le premier paramètre est le nom de l'item, puis la valeur en second

	//}


}


// ============================================================================
// Event listeners
// ============================================================================

addCartButton.addEventListener('click', addCart);

