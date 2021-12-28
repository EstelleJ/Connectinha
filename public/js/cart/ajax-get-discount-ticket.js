import {ajax} from '../tools/functions.js';
import CartProduct from '../Classes/CartProduct.js';

// ============================================================================
// Variables
// ============================================================================

const cartRows       = document.getElementsByTagName("cart-row");
const addTicketBtn = document.getElementById('addTicket');
const ticketInput = document.getElementById('discountTicket');
let domTotalPrice = document.getElementById('cart-total-price');
const ticketCode = document.getElementById('ticketCode');
const errorTicket = document.getElementById('errorTicket');

// ============================================================================
// Functions
// ============================================================================

async function getDiscountTicket() {

	let discountTicket = ticketInput.value;
	let arrayProducts = [];

	if(discountTicket.length !== 0){

		for (let product of cartRows) {

			let dataset = JSON.parse(product.dataset.product);

			let productId      = dataset.id;
			let title          = dataset.title;
			let slug           = dataset.slug;
			let discount       = dataset.discount;
			let mantraSelected = dataset.mantra;
			let price          = dataset.price;
			let weight         = dataset.weight;

			let quantitySelected = product.querySelector('.item-quantity');
			arrayProducts.push(new CartProduct(productId, title, slug, discount, mantraSelected, parseInt(quantitySelected.value), price, weight));

		}

		let formData = new FormData();
		formData.append('ajax-discount-ticket', discountTicket.toString());
		formData.append('ajax-array-products', JSON.stringify(arrayProducts));


		const response = await ajax('POST', '/ajax/get-discount-ticket/', formData);
		console.log(response);

		/* Si le bon existe ou pas */
		if(response.discount !== 'invalid') {

			console.log(ticketCode.innerHTML);

			if(ticketCode.innerHTML === ''){
				document.getElementById('cart-total-price').innerHTML = response.price.toFixed(2) + ' € TTC';
				/* Affichage du nom du bon utilisé */
				ticketCode.innerHTML = discountTicket + ' | -' + response.discount;
				errorTicket.innerHTML = "";

				document.getElementById('discountForm').classList.add('inactive');
				document.getElementById('domDiscountTicket').classList.add('active');
			}
			else {
				errorTicket.innerHTML = "Vous ne pouvez activer qu'un seul bon à la fois"
			}
		}
		else {
			errorTicket.innerHTML = "Votre bon n'est pas valide";
		}

	}


}


// ============================================================================
// Event listeners
// ============================================================================
addTicketBtn.addEventListener('click', getDiscountTicket);