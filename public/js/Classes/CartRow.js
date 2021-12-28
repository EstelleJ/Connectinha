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
		let mantra;
		let price;
		let discount;
		let priceBeforeDiscount;

		/* Mantra ou pas */
		if (product.mantra !== null) {
			mantra = product.mantra;
		}
		else {
			mantra = '';
		}

		/* Prix de base ou prix après promotion */
		if (product.discount !== 'null') {
			price = product.price - (product.price * (product.discount / 100));
		}
		else {
			price = product.price;
		}

		/* Prix avant promotion */
		if (product.discount !== 'null') {
			priceBeforeDiscount = parseFloat(product.price).toFixed(2) + '€';
		}
		else {
			priceBeforeDiscount = '';
		}

		/* Promotion */
		if (product.discount !== 'null') {
			discount = '-' + product.discount + '%';
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
		// this.getShippingCost().then();

		// Event listeners
		this.querySelector('.item-delete').addEventListener('click', this.deleteRow.bind(this));
		this.querySelector('.item-quantity').addEventListener('input', this.updateTotalPrices.bind(this));
		this.querySelector('.less').addEventListener('click', this.lessQuantity.bind(this));
		this.querySelector('.more').addEventListener('click', this.moreQuantity.bind(this));
	}


	async getProductFromBackEnd() {
		const productData = JSON.parse(this.dataset.product);
		const productId   = productData.id;
		const mantra = productData.mantra;

		let formData = new FormData();
		formData.append('id', productId);
		formData.append('mantra', mantra);

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
		let quantity = parseInt(this.querySelector('.item-quantity').value);

		if (quantity > 1) {
			this.querySelector('.item-quantity').value = quantity - 1;

			this.updateTotalPrices();
		}
	}

	moreQuantity() {
		let quantity = parseInt(this.querySelector('.item-quantity').value);

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

		this.getShippingCost(totalPrice).then();
	}

	async getShippingCost(totalPrice) {
		const cartRows     = document.getElementsByTagName("cart-row");
		const shippingCost = document.getElementById('shipping-cost');
		const domTotalPrice = document.getElementById('cart-total-price');

		let totalWeight = 0;

		for (let product of cartRows) {
			let dataset  = JSON.parse(product.dataset.product);
			let weight   = dataset.weight;
			let quantity = 1;
			if (!!product.querySelector('.item-quantity')) {
				parseInt(quantity = product.querySelector('.item-quantity').value);
			}

			totalWeight += parseFloat(weight) * quantity;
		}

		let formData = new FormData();
		formData.append('ajax-total-weight', totalWeight.toString());

		const response = await this.ajax('POST', '/ajax/get-shipping-cost/', formData);

		shippingCost.innerHTML = response.toString();

		const totalPriceWithShippingCost = parseFloat(response.toString()) + parseFloat(totalPrice.toFixed(2));

		console.log('response = ' + response.toString());
		console.log('totalPrice = ' + parseFloat(totalPrice));
		console.log('totalPriceWithShippingCost = ' + totalPriceWithShippingCost);

		domTotalPrice.innerHTML = totalPriceWithShippingCost + ' € TTC';
	}

}
