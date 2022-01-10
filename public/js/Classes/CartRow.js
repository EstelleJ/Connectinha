import WebComponent from './WebComponent.js';
import CartProduct from './CartProduct.js';

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

	addCart(newQuantity) {

		let dataset = JSON.parse(this.dataset.product);

		let arrayProducts = [];

		let currentProduct = new CartProduct(dataset.id, dataset.title, dataset.slug, dataset.discount, dataset.mantra, newQuantity, dataset.price, dataset.weight);

		let localStorageItems = localStorage.getItem('products');

		if (!!localStorageItems) {
			let cart = JSON.parse(localStorageItems);

			let found = false;
			for (const item of cart) {
				if (item.id === currentProduct.id && item.mantra === currentProduct.mantra && item.discount === currentProduct.discount) {
					item.quantity = newQuantity;
					found = true;
					break;
				}
			}

			if (!found) {
				cart.push(currentProduct);
			}

			localStorage.setItem('products', JSON.stringify(cart));
		}
	}

	lessQuantity() {
		let quantity = parseInt(this.querySelector('.item-quantity').value);

		if (quantity > 1) {
			this.querySelector('.item-quantity').value = quantity - 1;

			this.updateTotalPrices();
		}

		let newQuantity = quantity - 1;

		this.addCart(newQuantity);
	}

	moreQuantity() {
		let quantity = parseInt(this.querySelector('.item-quantity').value);

		this.querySelector('.item-quantity').value = quantity + 1;

		this.updateTotalPrices();

		let newQuantity = quantity + 1;

		this.addCart(newQuantity);
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
		formData.append('ajax-total-price', totalPrice);

		const response = await this.ajax('POST', '/ajax/get-shipping-cost/', formData);

		shippingCost.innerHTML = response.toString();

		const totalPriceWithShippingCost = parseFloat(response.toString()) + parseFloat(totalPrice.toFixed(2));

		domTotalPrice.innerHTML = totalPriceWithShippingCost + ' € TTC';
	}

}
