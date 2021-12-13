import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const cartRows = document.getElementsByTagName("cart-row");
const saveButton = document.getElementById("save-btn");

let arrayProducts = [];

// ============================================================================
// Functions
// ============================================================================
async function getCart(e) {
	e.preventDefault();

	console.log(cartRows);

	const element = this;

	let formData = new FormData();
	formData.append('ajax-customer-id', this.dataset.id);

	// const response = await ajax('POST', '/ajax/save-cart/', formData);
	// if (response === 'ok') {
	// 	element.closest('.element.customer').remove();
	// }

}


// ============================================================================
// Event listeners
// ============================================================================
saveButton.addEventListener('click', getCart);
