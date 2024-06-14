<script lang="ts">
    import { handleSubmit } from 'resources/js/lib/util/formSubmit';
	import { isfixed } from '../../lib/util/headerFixed';
    import PasswordIput from '../shared/passwordIput.svelte';
    import { useForm } from "@inertiajs/svelte";
    $isfixed = false;

	const form = useForm({
		password: null,
		confirm: null,
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
						<h1 class="title">Change Password</h1>
						<p>For added security, it's a good idea to update your password regularly. Enter your current password and choose a strong new one to keep your account protected.</p>
					</div>
					<form id="form" method="post" action="/password" on:submit={()=>handleSubmit($form,"/password")}>
						<PasswordIput bind:value={$form.password} />
						<PasswordIput bind:value={$form.confirm} name="confirm" placeholder="Confirm Password"  />
					</form>
					<button form="form" type="submit" class="btn btn-primary mb-3 btn-block">SUBMIT</button>
					<div class="flex items-center justify-center">
						<a href={void(0)} class="text-light text-center block">Don’t have an account?</a>
						<a href="/register" class="btn-link block ml-2 text-underline">SignUp here</a>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- Welcome End -->