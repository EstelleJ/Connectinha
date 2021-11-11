import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deleteSubcategory(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer cette sous-catégorie ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-subcategory-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/subcategory', formData);
		if (response === 'ok') {
			element.closest('.element.subcategory').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteSubcategory);
}
