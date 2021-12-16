import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================

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
	let totalPrice = domTotalPrice.innerHTML.split(' ')[0];

	if(discountTicket.length !== 0){

		let formData = new FormData();
		formData.append('ajax-discount-ticket', discountTicket.toString());
		formData.append('ajax-total-price', totalPrice.toString());

		console.log(totalPrice);
		console.log(discountTicket);

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