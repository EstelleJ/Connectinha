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

	let confirm = window.confirm("Souhaitez-vous vraiment supprimer cette promotion ?");

	if (confirm) {

		const element = this;

		let formData = new FormData();
		formData.append('ajax-offer-id', this.dataset.id);

		const response = await ajax('POST', '/ajax/delete/special-offers', formData);
		if (response === 'ok') {
			element.closest('.element.offer').remove();
		}
	}
}


// ============================================================================
// Event listeners
// ============================================================================
for (const deleteButton of deleteButtons) {
	deleteButton.addEventListener('click', deleteTva);
}
