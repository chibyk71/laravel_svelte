<script lang="ts">
	import { CheckSolid } from 'svelte-awesome-icons';
	import TopBar from '../lib/nav/topBar.svelte';
    import { useForm } from "@inertiajs/svelte";
    import { User } from '../lib/type';
    import { UserAvatar } from '../lib/util/userStore';
    import Title from './shared/title.svelte';
	export let user:User
    const form = useForm({
        name: user.name
    })

const handleSubmit = () => {
    $form.patch("/login")
}
</script>

<Title title="Profile" />
<TopBar title="edit profile">
    <svelte:fragment slot="right">
        <button type="submit" form="update" class="btn btn-sm bg-primary">						
            <CheckSolid class="w-4 h-4" />
        </button>
    </svelte:fragment>
</TopBar>
<!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="edit-profile">
				<div class="profile-image">
					<div class="media media-100 rounded-circle">
						<img src={UserAvatar(user.name)} alt="/">	
					</div>
					<a href={void(0)}>Change profile photo</a>
				</div>
				<form on:submit|preventDefault={handleSubmit} method="post" id="update">
					<div class="mb-3 input-group input-mini">
						<input type="text" name="name" aria-invalid={$form.errors.name ? 'true' : undefined} bind:value={$form.name} class="form-control" placeholder="Name" >
					</div>
				</form>
            </div>
			<ul class="link-list mt-5">
				<li></li>
				<li>
					<a href={void(0)}>Change Password</a>
				</li>
			</ul>	
        </div>
    </div>
    <!-- Page Content End-->