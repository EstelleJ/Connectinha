import {ajax} from '../tools/functions.js';


// ============================================================================
// Variables
// ============================================================================
const orderNumber = localStorage.getItem('order');
const allProductsDOM = document.getElementById('allProducts');
const totalPriceDOM = document.getElementById('totalPriceDOM');

console.log(orderNumber);

// ============================================================================
// Functions
// ============================================================================
let formData = new FormData();
formData.append('ajax-order-number', orderNumber);

const response = await ajax('POST', '/ajax/get-order/', formData);

console.log(response);


displayProducts();

function displayProducts() {
	const products = JSON.parse(response.products);
	console.log(products);

	for(let product of products){

		let mantra = '';
		if(product.mantra !== null){
			mantra = product.mantra;
		}

		let getPrice = parseInt(product.price);
		let getQuantity = parseInt(product.quantity);
		let price = getPrice.toFixed(2);
		let totalPrice = (getQuantity * price).toFixed(2);

		allProductsDOM.innerHTML +=
				`
					<div class="product">
						<div class="info">
							<h4>${product.title}</h4>
							<p class="mantra">${mantra}</p>
						</div>
						<div class="details">
							<p>Quantité : ${product.quantity}</p>
							<p>Prix à l'unité : ${price} €</p>
							<p class="total">Prix total : ${totalPrice} €</p>
						</div>
					</div>
				`
		;
	}

	totalPriceDOM.innerHTML = response.price;

}