import {ajax} from './tools/functions.js';

// ============================================================================
// Variables
// ============================================================================

// ============================================================================
// Functions
// ============================================================================

let arrayProducts = localStorage.getItem('products');

let formData = new FormData();

let cartProducts = arrayProducts;

// console.log('===========');
// console.log(cartProducts);
// console.log('===========');

formData.append('cart', cartProducts);


const response = await ajax('POST', '/ajax/get-cart/', formData);

console.log(JSON.parse(response));

