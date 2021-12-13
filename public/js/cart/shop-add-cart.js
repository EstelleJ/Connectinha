import CartProduct from '../Classes/CartProduct.js';

// ============================================================================
// Variables
// ============================================================================
const addCartButton = document.getElementById("addCart");


// ============================================================================
// Functions
// ============================================================================
async function addCart() {

	document.getElementById('modal').classList.add('active');
	setTimeout(function() {
		document.getElementById('modal').classList.remove('active');
	}, 3000);

	// On vérifie si le select mantra exist, pour ajouter ou non un mantra.
	// La valeur sera null si il n'y a pas de mantras à choisir sur ce produit
	let mantraSelectTag = document.getElementById('mantraSelect');
	// console.log(mantraSelectTag);
	let mantraSelected = null;

	if (mantraSelectTag !== null) {
		mantraSelected = mantraSelectTag.value;
	}

	// console.log(mantraSelected);

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
			if (item.id === currentProduct.id && item.mantra === currentProduct.mantra) {
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
