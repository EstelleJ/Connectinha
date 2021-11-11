import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deletePaymentMethods(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer cette méthode de paiement ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-method-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/method', formData);
		if (response === 'ok') {
			element.closest('.element.method').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deletePaymentMethods);
}
