<script lang="ts">
    import { handleSubmit } from '../../lib/util/formSubmit';
	import { isfixed } from '../../lib/util/headerFixed';
    import { useForm } from "@inertiajs/svelte";
    import PasswordIput from '../shared/passwordIput.svelte';
    const form = useForm({
        email: null,
        password: null,
        remember: true
    });
    $isfixed = false
</script>
 <!-- Welcome Start -->
	<div class="content-body">
		<div class="container h-screen">
			<div class="welcome-area">
				<div class="bg-image bg-image-overlay" style="background-image: url(images/login/pic4.jpg);"></div>
				<div class="join-area">
					<div class="started">
						<h1 class="title">Sign in</h1>
						<p>Welcome back! Already have an account? Sign in below to access your data and features.</p>
					</div>
					<form action="/login" on:submit|preventDefault={()=>handleSubmit($form,"/login")} method="post" id="login">
						<div class="mb-3 input-group input-group-icon">
							<span class="input-group-text">
								<div class="input-icon">
									<svg width="19" height="19" viewBox="0 0 19 19" fill="none">
										<path d="M15.587 16.3479V14.8261C15.587 14.019 15.2663 13.2448 14.6956 12.6741C14.1248 12.1033 13.3507 11.7827 12.5435 11.7827H6.45655C5.64937 11.7827 4.87525 12.1033 4.30448 12.6741C3.73372 13.2448 3.41307 14.019 3.41307 14.8261V16.3479" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										<path d="M9.50002 8.73918C11.1809 8.73918 12.5435 7.37657 12.5435 5.6957C12.5435 4.01483 11.1809 2.65222 9.50002 2.65222C7.81915 2.65222 6.45654 4.01483 6.45654 5.6957C6.45654 7.37657 7.81915 8.73918 9.50002 8.73918Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
								</div>
							</span>
							<input type="email" bind:value={$form.email} name="email" class="form-control w-full" placeholder="Email">
						</div>
						<PasswordIput bind:value={$form.password} name="password" placeholder="password" />
					</form>
					<a href="/forgotpassword" class="btn-link block mb-3 text-end text-underline">Forgot Password</a>	
					<button form="login" type="submit" class="btn btn-primary btn-block mb-3">SIGN IN</button>
					<div class="social-box">
						<span>Or sign in with</span>
						<div class="flex justify-between">
							<img src="images/icons/facebook.png" alt="/">
							<img src="images/icons/google.png" alt="/">
						</div>
					</div>	
					<div class="flex items-center justify-center">
						<a href={void(0)} class="text-light text-center block">Don’t have an account?</a>
						<a href="/register" class="btn-link block ml-3 text-underline">Signup here</a>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- Welcome End -->