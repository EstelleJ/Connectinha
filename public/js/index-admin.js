import {ajax} from './tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deleteProduct(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer ce produit ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-product-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/product', formData);
		if (response === 'ok') {
			element.closest('.element.produit').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteProduct);
}
