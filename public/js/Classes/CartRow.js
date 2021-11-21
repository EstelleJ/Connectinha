import WebComponent from './WebComponent.js';

export default class CartRow extends WebComponent {

	constructor() {
		super();

		this.template = 'cart-row.html';

		this.init().then();
	}


	async init() {
		let template = document.createElement('template');
		template.innerHTML = await this.fetchHtml(this.templatesUrl + this.template);

		this.appendChild(template.content);

		// Event listeners
		this.querySelector('.item-delete').addEventListener('click', this.deleteRow.bind(this));
	}


	deleteRow() {
		this.remove();
	}
}
