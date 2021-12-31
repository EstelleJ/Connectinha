import CartProduct from '../Classes/CartProduct.js';

// ============================================================================
// Variables
// ============================================================================
const replaceButton = document.getElementById("replaceButton");
const products = document.getElementsByClassName("product-saved");

// ============================================================================
// Functions
// ============================================================================
async function replaceCart() {

	document.getElementById('modal').classList.add('active');
	setTimeout(function() {
		document.getElementById('modal').classList.remove('active');
	}, 3000);

	localStorage.removeItem('products');

	for(let product of products){

			// On vérifie si le select mantra exist, pour ajouter ou non un mantra.
			// La valeur sera null si il n'y a pas de mantras à choisir sur ce produit
			let mantra = product.dataset.mantra;

			let quantitySelected = product.dataset.quantity;

			let productId = product.dataset.id;
			let title     = product.dataset.title;
			let slug      = product.dataset.slug;
			let discount  = product.dataset.discount;
			let price     = product.dataset.price;
			let weight    = product.dataset.weight;

			let arrayProducts = [];

			let currentProduct = new CartProduct(productId, title, slug, discount, mantra, parseInt(quantitySelected), price, weight);

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
}


// ============================================================================
// Event listeners
// ============================================================================
replaceButton.addEventListener('click', replaceCart);
