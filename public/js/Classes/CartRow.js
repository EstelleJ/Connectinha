import WebComponent from './WebComponent.js';

export default class CartRow extends WebComponent {

	constructor() {
		super();

		this.template = 'cart-row.html';

		this.init().then();
	}


	async init() {
		let template      = document.createElement('template');
		let html          = await this.fetchHtml(this.templatesUrl + this.template);
		const productData = JSON.parse(this.dataset.product);

		let product = await this.getProductFromBackEnd();
		let mantra = '';
		let price   = '';
		let discount = '';
		let priceBeforeDiscount = '';

		/* Mantra ou pas */
		if (productData.mantra !== null) {
			mantra = productData.mantra;
		}
		else {
			mantra = '';
		}

		/* Prix de base ou prix après promotion */
		if (productData.discount !== 'null') {
			price = product.price - (product.price * (productData.discount / 100));
		}
		else {
			price = product.price;
		}

		/* Prix avant promotion */
		if (productData.discount !== 'null') {
			priceBeforeDiscount = parseFloat(product.price).toFixed(2) + '€';
		}
		else {
			priceBeforeDiscount = '';
		}

		/* Promotion */
		if(productData.discount !== 'null') {
			discount = '-' + productData.discount + '%';
		}
		else {
			discount = '';
		}

		html = html.replaceAll('{{ name }}', product.name);
		html = html.replaceAll('{{ mantra }}', mantra);
		html = html.replaceAll('{{ price }}', parseFloat(price).toFixed(2));
		html = html.replaceAll('{{ priceBeforeDiscount }}', priceBeforeDiscount);
		html = html.replaceAll('{{ discount }}', discount);
		html = html.replaceAll('{{ quantity }}', productData.quantity);
		html = html.replaceAll('{{ totalPrice }}', (product.price * productData.quantity).toFixed(2));


		template.innerHTML = html;
		this.appendChild(template.content);

		this.updateTotalPrices();

		// Event listeners
		this.querySelector('.item-delete').addEventListener('click', this.deleteRow.bind(this));
		this.querySelector('.item-quantity').addEventListener('input', this.updateTotalPrices.bind(this));
		this.querySelector('.less').addEventListener('click', this.lessQuantity.bind(this));
		this.querySelector('.more').addEventListener('click', this.moreQuantity.bind(this));
	}


	async getProductFromBackEnd() {
		const productData = JSON.parse(this.dataset.product);
		const productId   = productData.id;

		let formData = new FormData();
		formData.append('id', productId);

		return await this.ajax('POST', '/ajax/get-product/', formData);
	}


	deleteRow() {
		const productData = JSON.parse(this.dataset.product);
		let storageCart   = JSON.parse(localStorage.getItem('products'));

		const indexOfProduct = storageCart.indexOf(productData);
		storageCart.splice(indexOfProduct);

		localStorage.setItem('products', JSON.stringify(storageCart));

		this.remove();
		this.updateTotalPrices();
	}

	lessQuantity() {
		let quantity                               = parseInt(this.querySelector('.item-quantity').value);
		this.querySelector('.item-quantity').value = quantity - 1;

		this.updateTotalPrices();
	}

	moreQuantity() {
		let quantity                               = parseInt(this.querySelector('.item-quantity').value);
		this.querySelector('.item-quantity').value = quantity + 1;

		this.updateTotalPrices();
	}

	updateTotalPrices() {
		const domTotalPrice = document.getElementById('cart-total-price');
		const domUnitPrices = document.getElementsByClassName('item-unit-price');

		let unitPrice = parseFloat(this.querySelector('.item-unit-price').dataset.price);
		let quantity  = parseInt(this.querySelector('.item-quantity').value);

		this.querySelector('.item-price').value = (unitPrice * quantity).toFixed(2);

		let totalPrice = 0;
		for (const domUnitPrice of domUnitPrices) {
			let quantity = parseInt(domUnitPrice.parentElement.querySelector('.item-quantity').value);
			let price    = parseFloat(domUnitPrice.dataset.price);
			totalPrice += price * quantity;
		}

		domTotalPrice.innerHTML = totalPrice.toFixed(2) + ' € TTC';
	}

}
