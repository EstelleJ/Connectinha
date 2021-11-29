// ============================================================================
// Variables
// ============================================================================
const cartTable = document.getElementById('cart-table');

let cartProducts = [];

// ============================================================================
// Functions
// ============================================================================
function addCartRow(product) {
	let row = document.createElement('cart-row');
	row.dataset.product = JSON.stringify(product);
	cartTable.appendChild(row);
}

displayProducts();

function displayProducts(){
	let productRows = document.getElementsByTagName("cart-row");

	console.log(productRows);
	// console.log(productRows.length);

	// for(let i = 0; i < productRows.length; i++ ){
	// 	console.log(productRows[i])
	// }

	// Array.from(productRows).forEach(function(row){
	// 	console.log(row.length)
	// });
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
