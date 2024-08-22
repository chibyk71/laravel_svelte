<script lang="ts">
	import { isfixed } from '../../lib/util/headerFixed';
	import { useForm, inertia } from "@inertiajs/svelte";
    import PasswordIput from '../shared/passwordIput.svelte';
    import { handleSubmit } from '../../lib/util/formSubmit';
    $isfixed = false

	const form = useForm({
		password: null,
		confirm: null
	})

</script>
<!-- <TopBar title="change password" /> -->

<!-- Welcome Start -->
	<div class="content-body">
		<div class="container h-screen">
			<div class="welcome-area">
				<div class="bg-image bg-image-overlay" style="background-image: url(images/login/pic2.jpg);"></div>
				<div class="join-area">
					<div class="started">
						<h1 class="title">Reset Password</h1>
						<p>Almost there! Create a new, strong password. Once you've reset it, you can log back in securely.</p>
					</div>
					<form id="reset" method="post" action="/reset" on:submit|preventDefault={()=>handleSubmit($form,"/reset")}>
						<PasswordIput bind:value={$form.password} />
						<PasswordIput bind:value={$form.confirm} name="confirm" placeholder="Confirm Password"  />
					</form>
					<button form="reset" type="submit" class="btn btn-primary mb-3 btn-block">SUBMIT</button>
					<div class="flex items-center justify-center">
						<a href={void(0)} class="text-light text-center block">Don’t have an account?</a>
						<a use:inertia href="/register" class="btn-link block ml-2 text-underline">SignUp here</a>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- Welcome End -->