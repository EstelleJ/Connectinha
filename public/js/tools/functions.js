/**
 *
 * @param method
 * @param url
 * @param formData
 * @returns {Promise<unknown>}
 */
export async function ajax(method, url, formData) {
	const xhr = new XMLHttpRequest();
	xhr.open(method, url);
	xhr.send(formData);
	return new Promise((resolve, reject) => {
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					return resolve(JSON.parse(this.responseText));
				}
				else {
					return resolve('error');
				}
			}
		};
	});
}
