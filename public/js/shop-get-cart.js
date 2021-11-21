import {ajax} from './tools/functions.js';

// ============================================================================
// Variables
// ============================================================================

// ============================================================================
// Functions
// ============================================================================

let formData = new FormData();

if (!!localStorage.getItem('products')) {
	let arrayProducts = localStorage.getItem('products');

	formData.append('cart', arrayProducts);
}


// console.log('===========');
// console.log(cartProducts);
// console.log('===========');

const response = await ajax('POST', '/ajax/get-cart/', formData);
