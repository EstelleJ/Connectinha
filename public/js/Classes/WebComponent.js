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
}
