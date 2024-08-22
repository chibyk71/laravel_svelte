const CACHE_NAME = 'my-app-cache-v1';
const urlsToCache = [
	'/',
	'/manifest.json',
	// Add other assets to cache here
];

self.addEventListener('install', event => {
	event.waitUntil(
		caches.open(CACHE_NAME)
			.then(cache => {
				return cache.addAll(urlsToCache);
			})
	);
});

self.addEventListener('fetch', (event) => {
	const request = event.request;

	if (request.method === 'POST' || request.method === 'PUT' || request.method === 'DELETE') {
		event.respondWith(
			(async () => {
				const clonedRequest = request.clone();

				// Retrieve the CSRF token from cookies or storage
				const csrfToken = getCookie('XSRF-TOKEN'); // Implement getCookie function

				// Create a new request with the CSRF token in the headers
				const modifiedRequest = new Request(clonedRequest, {
					headers: new Headers({
						'X-CSRF-TOKEN': csrfToken,
						...clonedRequest.headers
					})
				});

				return fetch(modifiedRequest).then((response) => {
					return response;
				}).catch((error) => {
					console.error('Fetch failed:', error);
					throw error;
				});
			})()
		);
	}
});

// Helper function to get cookie value
function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}


self.addEventListener('activate', event => {
	const cacheWhitelist = [CACHE_NAME];
	event.waitUntil(
		caches.keys().then(cacheNames => {
			return Promise.all(
				cacheNames.map(cacheName => {
					if (cacheWhitelist.indexOf(cacheName) === -1) {
						return caches.delete(cacheName);
					}
				})
			);
		})
	);
});
