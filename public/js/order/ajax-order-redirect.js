import {ajax} from '../tools/functions.js';


// ============================================================================
// Variables
// ============================================================================
const orderNumber = localStorage.getItem('order');
const confirmButton = document.getElementById('confirm-btn');

// ============================================================================
// Functions
// ============================================================================

async function redirect(e){
	e.preventDefault();

	let formData = new FormData();
	formData.append('ajax-order-number', orderNumber);

	const response = await ajax('POST', '/ajax/redirect-order/', formData);

	console.log('response = '+response);

	if(response !== 'error'){
		window.location.href = '/panier/commande/recapitulatif-'+orderNumber+'/';
	}else {
		window.location.href = '/panier/commande/';
	}

}

// ============================================================================
// Event listeners
// ============================================================================
confirmButton.addEventListener('click', redirect);