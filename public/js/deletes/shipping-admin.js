import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deleteTva(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer cette tranche de frais de port ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-shipping-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/shipping', formData);
		if (response === 'ok') {
			element.closest('.element.shippings').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteTva);
}
