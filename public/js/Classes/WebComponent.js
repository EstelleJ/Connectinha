/**
 *
 */
export default class WebComponent extends HTMLElement {

	constructor() {
		super();

		this.templatesUrl = '/templates/';
	}


	fetchHtml(url) {
		return fetch(url)
				.then(function(response) {
					return response.text();
				})
				.then(function(html) {
					return html;
				});
	}


	ajax(method, url, formData) {

		let init = {
			method: method,
			body  : formData,
		}

		return fetch(url, init)
				.then(function(response) {
					if (response.ok) {
						return response.text();
					}
					else {
						throw new Error('erreur !');
					}
				})
				.then(function(response) {
					return JSON.parse(response.toString());
				})
				.catch((error) => {
					console.log(error);
				});
	}
}
