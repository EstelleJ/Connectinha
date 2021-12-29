import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const deleteButton = document.getElementById('deleteButton');


// ============================================================================
// Functions
// ============================================================================
async function deleteUser(e) {

	e.preventDefault();

	let formData = new FormData();

	const response = await ajax('POST', '/ajax/save-cart/', formData);

	if (response === 'ok') {

		window.location.href = '/';

	}

}

// ============================================================================
// Event listeners
// ============================================================================
deleteButton.addEventListener('click', deleteUser);