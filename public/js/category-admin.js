import {ajax} from './tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deleteCategory(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer cette catégorie ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-category-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/category', formData);
		if (response === 'ok') {
			element.closest('.element.category').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteCategory);
}
