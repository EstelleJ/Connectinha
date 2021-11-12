import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deleteProduct(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer ce mantra ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-mantra-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/mantra', formData);
		if (response === 'ok') {
			element.closest('.element.produit-mantra').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteProduct);
}
