
// ============================================================================
// Variables
// ============================================================================
const orderNumber = localStorage.getItem('order');
const orderDetailsButton = document.getElementById('order-details');

// ============================================================================
// Functions
// ============================================================================

async function redirect(e){
	e.preventDefault();

	if (!!orderNumber) {
		window.location.href = '/panier/commande/recapitulatif-' + orderNumber + '/';
	}
}

// ============================================================================
// Event listeners
// ============================================================================
orderDetailsButton.addEventListener('click', redirect);
