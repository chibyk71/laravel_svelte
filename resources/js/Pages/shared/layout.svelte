<script lang="ts">
	import { isfixed } from '../../lib/util/headerFixed';
	import Canvas from '../../lib/comp/canvas.svelte';
    import { handleInstallPrompt } from '@/lib';
    import { fade } from 'svelte/transition';
    import { onMount } from 'svelte';
	let loaded = true;
	onMount(async ()=> {
		loaded = false;
	})

	// Function to detect iOS devices
	function isThisDeviceRunningiOS() {
		let pwaBtn = document.querySelector('.pwa-btn');
		let installText = document.querySelector('.pwa-text');
		const iOSDevices = ['iPad Simulator', 'iPhone Simulator', 'iPod Simulator', 'iPad', 'iPhone', 'iPod']
		const isIOS = iOSDevices.includes(navigator.platform) || (navigator.userAgent.includes('Mac OS X') && navigator.maxTouchPoints && navigator.maxTouchPoints > 1)
		if (isIOS && installText && pwaBtn) {
			installText.innerHTML = 'Install Soziety social network mobile app template to your home screen for easy access click to safari share option "Add to Home Screen".';
			pwaBtn.remove();
			return true;
		}
		return false;
		
	}
</script>
<div class="page-wraper" class:header-fixed={$isfixed}> 
	{#if loaded}
     <!-- splash -->        
        <div class="loader-screen" id="splashscreen" out:fade>
            <div class="main-screen">
                <div class="circle-2"></div>
                <div class="circle-3"></div>
                <div class="circle-4"></div>
                <div class="circle-5"></div>
                <div class="circle-6"></div>
                <div class="brand-logo">
                    <div class="logo flex items-center justify-center">
                        <img src="/images/vector.svg" alt="spoon-1" class="wow bounceInDown">
                    </div>
                    <div id="loading-area" class="loading-page-4">
                    <div class="loading-inner">
                        <div class="load-text">
                            <span data-text="F" class="text-load">F</span>
                            <span data-text="L" class="text-load">L</span>
                            <span data-text="A" class="text-load">A</span>
                            <span data-text="U" class="text-load">U</span>
                            <span data-text="N" class="text-load">N</span>
                            <span data-text="T" class="text-load">T</span>
                            <span data-text="I" class="text-load">I</span>
                            <span data-text="T" class="text-load">T</span>
                        </div>
                    </div>
                </div>
                </div>
            </div>                                        
        </div>                                        
 	<!-- splash-->
   {/if}
    <slot />
</div>
<Canvas position="top" drag={false} id="login">
	<svelte:fragment slot="head">
		<h5 class="offcanvas-title">Login</h5>
	</svelte:fragment>
	<svelte:fragment slot="body">
		<form>
			<div class="mb-3 input-group input-group-icon">
				<span class="input-group-text">
					<div class="input-icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none">
							<path d="M15.587 16.3479V14.8261C15.587 14.019 15.2663 13.2448 14.6956 12.6741C14.1248 12.1033 13.3507 11.7827 12.5435 11.7827H6.45655C5.64937 11.7827 4.87525 12.1033 4.30448 12.6741C3.73372 13.2448 3.41307 14.019 3.41307 14.8261V16.3479" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M9.50002 8.73918C11.1809 8.73918 12.5435 7.37657 12.5435 5.6957C12.5435 4.01483 11.1809 2.65222 9.50002 2.65222C7.81915 2.65222 6.45654 4.01483 6.45654 5.6957C6.45654 7.37657 7.81915 8.73918 9.50002 8.73918Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</div>
				</span>
				<input type="email" class="form-control" placeholder="Email Address">
			</div>
			<div class="mb-3 input-group input-group-icon">
				<span class="input-group-text">
					<div class="input-icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none">
							<path d="M15.587 16.3479V14.8261C15.587 14.019 15.2663 13.2448 14.6956 12.6741C14.1248 12.1033 13.3507 11.7827 12.5435 11.7827H6.45655C5.64937 11.7827 4.87525 12.1033 4.30448 12.6741C3.73372 13.2448 3.41307 14.019 3.41307 14.8261V16.3479" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M9.50002 8.73918C11.1809 8.73918 12.5435 7.37657 12.5435 5.6957C12.5435 4.01483 11.1809 2.65222 9.50002 2.65222C7.81915 2.65222 6.45654 4.01483 6.45654 5.6957C6.45654 7.37657 7.81915 8.73918 9.50002 8.73918Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</div>
				</span>
				<input type="text" class="form-control" placeholder="Phone Number">
			</div>
			<button type="submit" class="btn btn-primary btn-block mb-2">Login</button>
		</form>
	</svelte:fragment>
</Canvas>

<Canvas class="pwa-offcanvas" small={true} drag={false} id="pwa-install" on:opened={isThisDeviceRunningiOS}>
	<svelte:fragment slot="body">
		<div class="container">
			<img class="logo" src="images/icon.png" alt="">
			<h5 class="title">Soziety on Your Home Screen</h5>
			<p class="pwa-text">Install Soziety social network mobile app template to your home screen for easy access, just like any other app</p>
			<button type="button" on:click={handleInstallPrompt} class="btn btn-sm btn-primary pwa-btn">Add to Home Screen</button>
			<button type="button" class="btn btn-sm pwa-close light btn-secondary ml-2">Maybe later</button>
		</div>
	</svelte:fragment>
</Canvas>