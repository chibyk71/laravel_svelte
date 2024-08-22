import { writable } from "svelte/store";
import { canvas } from "./comp/canvasStore";

// Register Service worker to control making site work offline
if ('serviceWorker' in navigator) {
	navigator.serviceWorker
		.register('service-worker.js')
		.then(() => {
			console.log('Service Worker Registered');
		})
		.catch((error) => {
			console.error('Service Worker Registration failed:', error);
		});
}

// Code to handle install prompt on desktop
let deferredPrompt = writable(null);
const CANVAS_ID = 'pwa-install';
const PwaKey = 'pwa-modal';
const PwaValue = getCookie(PwaKey);

export function handleInstallPrompt() {
	deferredPrompt.update((prompt) => {
		if (prompt) {
			prompt.prompt();
			prompt.userChoice.then((choiceResult) => {
				if (choiceResult.outcome === 'accepted') {
					canvas.close(CANVAS_ID)
					setCookie(PwaKey, false, 100);
				} else {
					console.log('User dismissed the A2HS prompt');
					// Handle what happens when user dismisses
				}
				deferredPrompt.set(null);
			});
		}
	});
}

window.addEventListener('beforeinstallprompt', (e) => {
	e.preventDefault();
	deferredPrompt.set(e);

	if (!PwaValue) {
		setTimeout(() => {
			canvas.open(CANVAS_ID)
		}, 3000);
	}
});

// Cookie functions
function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}

function setCookie(name, value, days) {
	let expires = "";
	if (days) {
		const date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
