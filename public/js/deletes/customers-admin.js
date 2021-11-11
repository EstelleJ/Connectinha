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

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer ce client ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-customer-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/customer', formData);
		if (response === 'ok') {
			element.closest('.element.customer').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteTva);
}
