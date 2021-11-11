import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButtons = document.querySelectorAll(".btn.delete");


// ============================================================================
// Functions
// ============================================================================
async function deleteService(e) {
	e.preventDefault();

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer ce service ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-service-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/service', formData);
		if (response === 'ok') {
			element.closest('.element.services').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteService);
}
