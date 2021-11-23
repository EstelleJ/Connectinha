// ============================================================================
// Classes
// ============================================================================
class CartProduct {
	constructor(id, mantra, quantity, price, weight) {
		this.id       = id;
		this.mantra   = mantra;
		this.quantity = quantity;
		this.price    = price;
		this.weight   = weight;
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

	let mantraSelected   = document.getElementById('mantraSelect').value;
	let quantitySelected = document.getElementById('number').value;

	let productId = this.dataset.id;
	let price     = this.dataset.price;
	let weight    = this.dataset.weight;

	let arrayProducts = [];

	let currentProduct = new CartProduct(productId, mantraSelected, parseInt(quantitySelected), price, weight);

	let localStorageItems = localStorage.getItem('products');

	if (!!localStorageItems) {
		let cart = JSON.parse(localStorageItems);

		let found = false;
		for (const item of cart) {
			if (item.id === currentProduct.id) {
				item.quantity += currentProduct.quantity;
				found = true;
				break;
			}
		}

		if (!found) {
			cart.push(currentProduct);
		}

		localStorage.setItem('products', JSON.stringify(cart));
	}
	else {
		arrayProducts.push(currentProduct);
		localStorage.setItem('products', JSON.stringify(arrayProducts));
	}
}


// ============================================================================
// Event listeners
// ============================================================================
addCartButton.addEventListener('click', addCart);
