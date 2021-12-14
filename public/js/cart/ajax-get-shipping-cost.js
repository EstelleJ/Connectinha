import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const cartRows     = document.getElementsByTagName("cart-row");
const shippingCost = document.getElementById('shipping-cost');


// ============================================================================
// Functions
// ============================================================================

let totalWeight = 0;


for (let product of cartRows) {
	let dataset = JSON.parse(product.dataset.product);
	let weight = dataset.weight;

	totalWeight += parseFloat(weight);
}
console.log(totalWeight);



const element = this;

let formData = new FormData();
formData.append('ajax-total-weight', totalWeight);

const response = await ajax('POST', '/ajax/get-shipping-cost/', formData);

shippingCost.innerHTML = response;

console.log(response);

