import {ajax} from '../tools/functions.js';


// ============================================================================
// Variables
// ============================================================================
const orderNumber = localStorage.getItem('order');

console.log(orderNumber);

// ============================================================================
// Functions
// ============================================================================
let formData = new FormData();
formData.append('ajax-order-number', orderNumber);

const response = await ajax('POST', '/ajax/get-order/', formData);

console.log(response);