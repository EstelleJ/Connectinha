import WebComponent from './WebComponent.js';

export default class CartRow extends WebComponent {

	constructor() {
		super();

		this.template = 'cart-row.html';

		this.init().then();
	}


	async init() {
		let template = document.createElement('template');
		let html = await this.fetchHtml(this.templatesUrl + this.template);
		const productData = JSON.parse(this.dataset.product);

		let product = await this.getProductFromBackEnd();
		html = html.replaceAll('{{ name }}', product.name);
		html = html.replaceAll('{{ price }}', product.price);
		html = html.replaceAll('{{ quantity }}', productData.quantity);
		html = html.replaceAll('{{ totalPrice }}', (product.price * productData.quantity) );

		template.innerHTML = html;
		this.appendChild(template.content);

		// Event listeners
		this.querySelector('.item-delete').addEventListener('click', this.deleteRow.bind(this));

	}


	async getProductFromBackEnd() {
		const productData = JSON.parse(this.dataset.product);
		const productId = productData.id;

		let formData = new FormData();
		formData.append('id', productId);

		const product = await this.ajax('POST', '/ajax/get-product/', formData);

		console.log(product);
		return product;
	}


	deleteRow() {
		this.remove();
	}
}
