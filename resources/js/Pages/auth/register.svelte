<script>
    import { handleSubmit } from '../../lib/util/formSubmit';
	import { isfixed } from '../../lib/util/headerFixed';
    import { useForm, inertia } from "@inertiajs/svelte";
	import PasswordIput from "../shared/passwordIput.svelte";
	$isfixed = false;
	
    const form = useForm({
        email: null,
        name: null,
        password: null
    })
</script>

<!-- Welcome Start -->
<div class="content-body">
	<div class="container h-screen">
		<div class="welcome-area">
			<div
				class="bg-image bg-image-overlay"
				style="background-image: url(images/login/pic3.jpg);"
			/>
			<div class="join-area">
				<div class="started">
					<h1 class="title">Create an Account</h1>
				</div>
				<form method="post" id="reg" on:submit|preventDefault={()=>handleSubmit($form,"/register")}>
					<div class="mb-3 input-group input-group-icon">
						<span class="input-group-text absolute left-0.5 top-0.5">
							<div class="input-icon">
								<svg width="19" height="19" viewBox="0 0 19 19" fill="none">
									<path
										d="M15.587 16.3479V14.8261C15.587 14.019 15.2663 13.2448 14.6956 12.6741C14.1248 12.1033 13.3507 11.7827 12.5435 11.7827H6.45655C5.64937 11.7827 4.87525 12.1033 4.30448 12.6741C3.73372 13.2448 3.41307 14.019 3.41307 14.8261V16.3479"
										stroke="white"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
									<path
										d="M9.50002 8.73918C11.1809 8.73918 12.5435 7.37657 12.5435 5.6957C12.5435 4.01483 11.1809 2.65222 9.50002 2.65222C7.81915 2.65222 6.45654 4.01483 6.45654 5.6957C6.45654 7.37657 7.81915 8.73918 9.50002 8.73918Z"
										stroke="white"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
								</svg>
							</div>
						</span>
						<input type="text" bind:value={$form.name} name="name" class="form-control !pl-12" placeholder="Name" />
					</div>
					<div class="mb-3 input-group input-group-icon">
						<span class="input-group-text absolute left-0.5 top-0.5">
							<div class="input-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path
										d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z"
										stroke="white"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
									<path
										d="M22 6L12 13L2 6"
										stroke="white"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
								</svg>
							</div>
						</span>
						<input type="email" bind:value={$form.email} name="email" class="form-control !pl-12" placeholder="Email" />
					</div>
					<PasswordIput bind:value={$form.password} name="password" placeholder="Password"/>
				</form>
                <button form="reg" type="submit" class="btn btn-primary btn-block mb-3">REGISTER</button>
				<div class="flex items-center justify-center">
					<a href={void(0)} class="text-light text-center block">Don’t have an account?</a>
					<a use:inertia href="/login" class="btn-link block ml-3 text-underline">Signin here</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Welcome End -->
