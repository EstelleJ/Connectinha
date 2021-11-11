// ============================================================================
// Variables
// ============================================================================

const datepickers = document.getElementsByClassName('datepicker');

let disabledDates = [];
let disabledWeekdays = [];
let maxDate = new Date('2099-12-31');

// ============================================================================
// Functions
// ============================================================================

function initDatePicker(id) {
	MCDatepicker.create({
		el             : '#' + id,
		dateFormat     : 'DD/MM/YYYY',
		bodyType       : 'modal',
		firstWeekday   : 1,
		customWeekDays : ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
		customMonths   : [
			'Janvier',
			'Février',
			'Mars',
			'Avril',
			'Mai',
			'Juin',
			'Juillet',
			'Août',
			'Septembre',
			'Octobre',
			'Novembre',
			'Décembre',
		],
		customOkBTN    : "Valider",
		customClearBTN : "Effacer",
		customCancelBTN: "Annuler",
		selectedDate   : new Date(),
		minDate        : new Date(),
		maxDate        : maxDate,
		disableDates   : disabledDates,
		disableWeekDays: disabledWeekdays,
	});
}

// ============================================================================
// Code to execute
// ============================================================================

for (const datepicker of datepickers) {
	// populate array of disabled dates
	const disabledDatesInput = datepicker.parentElement.querySelector('.datepicker-disabled-dates');
	if (disabledDatesInput !== null) {
		disabledDates = [];
		const disabledDatesValue = JSON.parse(disabledDatesInput.value);
		for (const date of disabledDatesValue) {
			disabledDates.push(new Date(date));
		}
	}

	// populate array of disabled weekdays
	const disabledWeekdaysInput = datepicker.parentElement.querySelector('.datepicker-disabled-weekdays');
	if (disabledWeekdaysInput !== null) {
		disabledWeekdays = JSON.parse(disabledWeekdaysInput.value);
	}

	// get max date
	const maxDateInput = datepicker.parentElement.querySelector('.datepicker-max-date');
	if (maxDateInput !== null) {
		maxDate = new Date(maxDateInput.value);
	}

	// init datepicker for each element with the class .datepicker
	initDatePicker(datepicker.id);
}

// ============================================================================
// Event listeners
// ============================================================================
