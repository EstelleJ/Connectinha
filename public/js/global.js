import {BetterMultiSelect} from './Classes/BetterMultiSelect.js';
import CartRow from './Classes/CartRow.js';

// ============================================================================
// Variables
// ============================================================================
const multiSelects = document.querySelectorAll('select[multiple]');


// ============================================================================
// Functions
// ============================================================================


// ============================================================================
// Code to execute
// ============================================================================
for (const multiSelect of multiSelects) {
	new BetterMultiSelect(multiSelect);
}

// Define web components
window.customElements.define('cart-row', CartRow);


// ============================================================================
// Event listeners
// ============================================================================
