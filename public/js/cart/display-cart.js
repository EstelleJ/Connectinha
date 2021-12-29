import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const cartTable  = document.getElementById('cart-table');
let cartProducts = [];


console.log('coucou');

// ============================================================================
// Functions
// ============================================================================
function addCartRow(product) {
	let row             = document.createElement('cart-row');
	row.dataset.product = JSON.stringify(product);
	cartTable.appendChild(row);
}

// ============================================================================
// Code to execute
// ============================================================================
if (!!localStorage.getItem('products')) {
	cartProducts = JSON.parse(localStorage.getItem('products'));
}

for (const product of cartProducts) {
	addCartRow(product);
}

// ============================================================================
// Event listeners
// ============================================================================
