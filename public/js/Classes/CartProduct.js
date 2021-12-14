export default class CartProduct {
	constructor(id, title, slug, discount, mantra, quantity, price, weight) {
		this.id       = id;
		this.title    = title;
		this.slug     = slug;
		this.discount = discount;
		this.mantra   = mantra;
		this.quantity = quantity;
		this.price    = price;
		this.weight   = weight;
	}
}
