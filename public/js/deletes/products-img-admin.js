import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deleteProductImg(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer cette image ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-product-img-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/product/img/', formData);
		if (response === 'ok') {
			element.closest('.miniature').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteProductImg);
}
