import {ajax} from '../tools/functions.js';

// ============================================================================
// Variables
// ============================================================================
const orderNumber = localStorage.getItem('order');
const submitButton = document.getElementById('submit');
const inputDuplicate = document.getElementById('same');


// ============================================================================
// Functions
// ============================================================================

function duplicate() {
	let deliveryName = document.getElementById('form_name').value;
	let deliveryFirstname = document.getElementById('form_firstname').value;
	let deliveryEmail = document.getElementById('form_email').value;
	let deliveryPhone = document.getElementById('form_phone').value;
	let deliveryAdress = document.getElementById('form_delivery_adress').value;
	let deliveryBuilding = document.getElementById('form_delivery_building').value;
	let deliveryApartment = document.getElementById('form_delivery_apartment').value;
	let deliveryCity = document.getElementById('form_delivery_city').value;
	let deliveryZipcode = document.getElementById('form_delivery_zipcode').value;
	let deliveryCountry = document.getElementById('form_delivery_country').value;

	if(inputDuplicate.checked == true){
		document.getElementById('form_invoicing_name').value = deliveryName;
		document.getElementById('form_invoicing_firstname').value = deliveryFirstname;
		document.getElementById('form_invoicing_email').value = deliveryEmail;
		document.getElementById('form_invoicing_phone').value = deliveryPhone;
		document.getElementById('form_invoicing_adress').value = deliveryAdress;
		document.getElementById('form_invoicing_building').value = deliveryBuilding;
		document.getElementById('form_invoicing_apartment').value = deliveryApartment;
		document.getElementById('form_invoicing_city').value = deliveryCity;
		document.getElementById('form_invoicing_zipcode').value = deliveryZipcode;
		document.getElementById('form_invoicing_country').value = deliveryCountry;
	}

}

async function updateOrder(e) {
	e.preventDefault();

	let deliveryName = document.getElementById('form_name').value;
	let deliveryFirstname = document.getElementById('form_firstname').value;
	let deliveryEmail = document.getElementById('form_email').value;
	let deliveryPhone = document.getElementById('form_phone').value;
	let deliveryAdress = document.getElementById('form_delivery_adress').value;
	let deliveryBuilding = document.getElementById('form_delivery_building').value;
	let deliveryApartment = document.getElementById('form_delivery_apartment').value;
	let deliveryCity = document.getElementById('form_delivery_city').value;
	let deliveryZipcode = document.getElementById('form_delivery_zipcode').value;
	let deliveryCountry = document.getElementById('form_delivery_country').value;

	let invoicingName = document.getElementById('form_invoicing_name').value;
	let invoicingFirstname = document.getElementById('form_invoicing_firstname').value;
	let invoicingEmail = document.getElementById('form_invoicing_email').value;
	let invoicingPhone = document.getElementById('form_invoicing_phone').value;
	let invoicingAdress = document.getElementById('form_invoicing_adress').value;
	let invoicingBuilding = document.getElementById('form_invoicing_building').value;
	let invoicingApartment = document.getElementById('form_invoicing_apartment').value;
	let invoicingCity = document.getElementById('form_invoicing_city').value;
	let invoicingZipcode = document.getElementById('form_invoicing_zipcode').value;
	let invoicingCountry = document.getElementById('form_invoicing_country').value;


	let formData = new FormData();
	formData.append('ajax-order-number', orderNumber);
	formData.append('ajax-delivery-name', deliveryName);
	formData.append('ajax-delivery-firstname', deliveryFirstname);
	formData.append('ajax-delivery-email', deliveryEmail);
	formData.append('ajax-delivery-phone', deliveryPhone);
	formData.append('ajax-delivery-adress', deliveryAdress);
	formData.append('ajax-delivery-building', deliveryBuilding);
	formData.append('ajax-delivery-apartment', deliveryApartment);
	formData.append('ajax-delivery-city', deliveryCity);
	formData.append('ajax-delivery-zipcode', deliveryZipcode);
	formData.append('ajax-delivery-country', deliveryCountry);
	formData.append('ajax-invoicing-name', invoicingName);
	formData.append('ajax-invoicing-firstname', invoicingFirstname);
	formData.append('ajax-invoicing-email', invoicingEmail);
	formData.append('ajax-invoicing-phone', invoicingPhone);
	formData.append('ajax-invoicing-adress', invoicingAdress);
	formData.append('ajax-invoicing-building', invoicingBuilding);
	formData.append('ajax-invoicing-apartment', invoicingApartment);
	formData.append('ajax-invoicing-city', invoicingCity);
	formData.append('ajax-invoicing-zipcode', invoicingZipcode);
	formData.append('ajax-invoicing-country', invoicingCountry);


	const response = await ajax('POST', '/ajax/update-order/', formData);

	if(deliveryName == "" || deliveryFirstname == "" || deliveryEmail == "" || deliveryPhone == "" || deliveryAdress == "" || deliveryCity == "" || deliveryZipcode == "" || deliveryCountry == "" || invoicingName == "" || invoicingFirstname == "" || invoicingEmail == "" || invoicingPhone == "" || invoicingAdress == "" || invoicingCity == "" || invoicingZipcode == "" || invoicingCountry == ""){
		alert('Merci de remplir tous les champs obligatoires');
	}else {
		window.location.href = '/panier/commande/choisissez-votre-methode-de-paiement-'+response+'/';
	}


}

// ============================================================================
// Event listeners
// ============================================================================
submitButton.addEventListener('click', updateOrder);
inputDuplicate.addEventListener('click', duplicate);
