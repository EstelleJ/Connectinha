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

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer ce bon ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-discount-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/discount', formData);
		if (response === 'ok') {
			element.closest('.element.tickets').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteTva);
}
